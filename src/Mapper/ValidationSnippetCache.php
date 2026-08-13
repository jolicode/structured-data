<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Mapper;

use JoliCode\StructuredData\Extraction\JsonLdElement;

/**
 * Caches the validation outcome of a JSON-LD snippet so that a snippet repeated
 * across documents (or within one document) is only expanded and validated once.
 *
 * On a cache hit, the snippet is still re-mapped against its parsed structure - so
 * line/column ranges stay specific to each occurrence - but the validators are
 * skipped: their outcome is replayed from a serialized "template" of the previous
 * validation.
 *
 * The cache is deliberately usable across audits (a worker validating many pages
 * of one site meets the same snippets over and over), and bounded by an LRU
 * eviction policy so that a long-lived process cannot grow it indefinitely.
 */
class ValidationSnippetCache
{
    /**
     * @var array<string, array{expandedJsonLd: array, validatedTypesByElement: array<int, array<int, array<string, mixed>>>}>
     */
    private array $entries = [];

    public function __construct(
        private readonly int $maxEntries = 32,
    ) {
    }

    /**
     * @param array<object> $validators
     */
    public function getKey(JsonLdElement $jsonLdElement, array $validators): string
    {
        $validatorsSignature = implode(
            "\0",
            array_map(
                static fn (object $validator): string => $validator::class,
                $validators,
            ),
        );

        return md5(
            $jsonLdElement->sourceFormat->value
            . "\0"
            . $validatorsSignature
            . "\0"
            . $jsonLdElement->content,
        );
    }

    /**
     * @return array{expandedJsonLd: array, validatedTypesByElement: array<int, array<int, array<string, mixed>>>}|null
     */
    public function get(string $key): ?array
    {
        if (!isset($this->entries[$key])) {
            return null;
        }

        // Move the entry to the end of the array so that the LRU eviction
        // (which removes from the front) keeps recently used entries alive.
        $entry = $this->entries[$key];
        unset($this->entries[$key]);

        return $this->entries[$key] = $entry;
    }

    /**
     * @param array<int, array<int, array<string, mixed>>> $validatedTypesByElement
     */
    public function store(string $key, array $expandedJsonLd, array $validatedTypesByElement): void
    {
        unset($this->entries[$key]);

        $this->entries[$key] = [
            'expandedJsonLd' => $expandedJsonLd,
            'validatedTypesByElement' => $validatedTypesByElement,
        ];

        while (\count($this->entries) > $this->maxEntries) {
            $oldestKey = array_key_first($this->entries);

            if (null === $oldestKey) {
                break;
            }

            unset($this->entries[$oldestKey]);
        }
    }

    public function reset(): void
    {
        $this->entries = [];
    }

    /**
     * @param array<MappedType> $types
     *
     * @return array<int, array<string, mixed>>
     */
    public function buildValidatedTypeTemplates(array $types): array
    {
        $templates = [];

        foreach ($types as $type) {
            $templates[] = $this->buildValidatedTypeTemplate($type);
        }

        return $templates;
    }

    /**
     * @param array<MappedType>                $types
     * @param array<int, array<string, mixed>> $templates
     */
    public function applyValidatedTypeTemplates(array $types, array $templates): void
    {
        foreach ($templates as $index => $template) {
            if (!isset($types[$index])) {
                continue;
            }

            $this->applyValidatedTypeTemplate($types[$index], $template);
        }
    }

    /**
     * @return array<string, mixed>
     */
    private function buildValidatedTypeTemplate(MappedType $type): array
    {
        $properties = [];

        foreach ($type->getProperties() as $name => $property) {
            $properties[$name] = $this->buildValidatedPropertyTemplate($property);
        }

        return [
            'description' => $type->getDescription(),
            'isPartOf' => $type->getIsPartOf(),
            'source' => $type->getSource(),
            'googleLink' => $type->getGoogleLink(),
            'errors' => $this->buildErrorTemplates($type->getErrors()),
            'properties' => $properties,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function buildValidatedPropertyTemplate(MappedProperty $property): array
    {
        $nestedType = null;
        $nestedTypes = [];
        $propertyValue = $property->getValue();

        if ($propertyValue instanceof MappedType) {
            $nestedType = $this->buildValidatedTypeTemplate($propertyValue);
        } elseif (\is_array($propertyValue)) {
            foreach ($propertyValue as $key => $entry) {
                if ($entry instanceof MappedType) {
                    $nestedTypes[$key] = $this->buildValidatedTypeTemplate($entry);
                }
            }
        }

        return [
            'description' => $property->getDescription(),
            'isPartOf' => $property->getIsPartOf(),
            'source' => $property->getSource(),
            'errors' => $this->buildErrorTemplates($property->getErrors()),
            'nestedType' => $nestedType,
            'nestedTypes' => $nestedTypes,
        ];
    }

    /**
     * @param array<MappedError> $errors
     *
     * @return array<int, array{message: string, severity: string, validatorName: ?string}>
     */
    private function buildErrorTemplates(array $errors): array
    {
        $templates = [];

        foreach ($errors as $error) {
            $templates[] = [
                'message' => $error->getMessage(),
                'severity' => $error->getSeverity(),
                'validatorName' => $error->getValidatorName(),
            ];
        }

        return $templates;
    }

    /**
     * @param array<string, mixed> $template
     */
    private function applyValidatedTypeTemplate(MappedType $type, array $template): void
    {
        $type->setDescription($template['description']);
        $type->setIsPartOf($template['isPartOf']);
        $type->setSource($template['source']);
        $type->setDocumentationLink($template['googleLink']);

        foreach ($template['properties'] as $name => $propertyTemplate) {
            $property = $type->getProperty($name);

            if (null === $property) {
                continue;
            }

            $this->applyValidatedPropertyTemplate($property, $type, $propertyTemplate);
        }

        foreach ($template['errors'] as $errorTemplate) {
            $this->replayMappedError($type, $type, $errorTemplate);
        }
    }

    /**
     * @param array<string, mixed> $template
     */
    private function applyValidatedPropertyTemplate(MappedProperty $property, MappedType $ownerType, array $template): void
    {
        $property->setDescription($template['description']);
        $property->addIsPartOf($template['isPartOf']);
        $property->addSource($template['source']);
        $value = $property->getValue();

        if (null !== $template['nestedType'] && $value instanceof MappedType) {
            $this->applyValidatedTypeTemplate($value, $template['nestedType']);
        }

        if (\is_array($value)) {
            foreach ($template['nestedTypes'] as $key => $nestedTemplate) {
                $nestedValue = $value[$key] ?? null;

                if ($nestedValue instanceof MappedType) {
                    $this->applyValidatedTypeTemplate($nestedValue, $nestedTemplate);
                }
            }
        }

        foreach ($template['errors'] as $errorTemplate) {
            $this->replayMappedError($property, $ownerType, $errorTemplate);
        }
    }

    /**
     * @param array{message: string, severity: string, validatorName: ?string} $errorTemplate
     */
    private function replayMappedError(MappedType|MappedProperty $target, MappedType $typeWithError, array $errorTemplate): void
    {
        $error = new MappedError(
            message: $errorTemplate['message'],
            property: $target instanceof MappedProperty ? $target->getKey() : null,
            type: MappedErrorFormatter::formatTypeLabel($typeWithError->getType()),
            severity: $errorTemplate['severity'],
            validatorName: $errorTemplate['validatorName'],
            ranges: MappedErrorFormatter::formatRanges($target->getValueRanges()),
            parent: $target,
        );

        $target->addError($error);
        $target->setIsValid(false);
        $errorSeverity = $errorTemplate['severity'];
        $targetErrorSeverity = $target->getErrorSeverity();

        if (MappedError::SEVERITY_ERROR !== $targetErrorSeverity && $targetErrorSeverity !== $errorSeverity) {
            $target->setErrorSeverity($errorSeverity);
        }

        $parentType = $target instanceof MappedProperty ? $target->getOwnerType() : $target->getParent();
        $isErrorSeverity = MappedError::SEVERITY_ERROR === $errorSeverity;

        if ($isErrorSeverity) {
            while ($parentType) {
                if (MappedError::SEVERITY_ERROR !== $parentType->getErrorSeverity()) {
                    $parentType->setErrorSeverity($errorSeverity);
                }

                $parentType->addChildrenError($error);
                $parentType = $parentType->getParent();
            }

            return;
        }

        while ($parentType) {
            $parentErrorSeverity = $parentType->getErrorSeverity();

            if (MappedError::SEVERITY_ERROR !== $parentErrorSeverity && $parentErrorSeverity !== $errorSeverity) {
                $parentType->setErrorSeverity($errorSeverity);
            }

            $parentType->addChildrenError($error);
            $parentType = $parentType->getParent();
        }
    }
}
