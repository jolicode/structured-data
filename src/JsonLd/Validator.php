<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd;

use Jolicode\JsonLd\Algorithms\Exception\JsonLdException;
use Jolicode\JsonLd\Algorithms\Expand\Expander;
use Jolicode\JsonLd\Algorithms\Http\IriResolver;
use Jolicode\JsonLd\Algorithms\JsonLd\Keyword;
use Jolicode\JsonLd\Audit\Audit;
use Jolicode\JsonLd\Extraction\Extractor;
use Jolicode\JsonLd\Extraction\ExtractorFormat;
use Jolicode\JsonLd\Extraction\JsonLdElement;
use Jolicode\JsonLd\Mapper\DocumentError;
use Jolicode\JsonLd\Mapper\DocumentIssueInterface;
use Jolicode\JsonLd\Mapper\MappedError;
use Jolicode\JsonLd\Mapper\MappedProperty;
use Jolicode\JsonLd\Mapper\MappedType;
use Jolicode\JsonLd\Mapper\ValidationMapper;
use Jolicode\JsonLd\Parser\DataStructures\ArrayStructure;
use Jolicode\JsonLd\Parser\DataStructures\ObjectStructure;
use Jolicode\JsonLd\Parser\JsonLdParser;
use Jolicode\JsonLd\Parser\Range;
use Jolicode\Vocabularies\Validators\RegisteredValidatorsContainer;
use JsonStreamingParser\Exception\ParsingException;

class Validator
{
    /**
     * @var array<string, array{expandedJsonLd: array, validatedTypesByElement: array<int, array<int, array<string, mixed>>>}>
     */
    private array $validatedSnippetCache = [];

    /**
     * @var array<string, array{elements: array<JsonLdElement>, documentIssues: array<DocumentIssueInterface>}>
     */
    private array $extractedElementsCache = [];

    private array $currentValidators = [];
    private ?string $currentValidatorsSignature = null;

    public function __construct(
        private readonly ValidationMapper $validationMapper = new ValidationMapper(),
        private readonly JsonLdParser $parser = new JsonLdParser(),
        private readonly RegisteredValidatorsContainer $validatorsContainer = new RegisteredValidatorsContainer(),
        private readonly Extractor $extractor = new Extractor(),
        private readonly Expander $expander = new Expander(),
    ) {
    }

    public function resetValidators(): void
    {
        $this->currentValidators = $this->validatorsContainer->getValidators();
        $this->currentValidatorsSignature = null;
    }

    public function setValidator(string $validator): void
    {
        if (class_exists($validator)) {
            $this->currentValidators = [$this->validatorsContainer->getValidator($validator)];
            $this->currentValidatorsSignature = null;

            return;
        }

        $validator = $this->validatorsContainer->getValidatorClassName($validator);

        if (false === $validator) {
            throw new \InvalidArgumentException('Unknown validator.');
        }

        $this->currentValidators = [$this->validatorsContainer->getValidator($validator)];
        $this->currentValidatorsSignature = null;
    }

    /**
     * This method returns an audit report for the schema.org types found in the
     * provided document, along with their properties, errors, and warnings.
     *
     * If required, it will make HTTP requests.
     */
    public function audit(string $input): Audit
    {
        $this->validationMapper->reset();

        if (!$this->currentValidators) {
            $this->resetValidators();
        }

        $extractCacheKey = $input;
        $documentIssues = [];

        if (isset($this->extractedElementsCache[$extractCacheKey])) {
            $elements = $this->extractedElementsCache[$extractCacheKey]['elements'];
            $documentIssues = $this->extractedElementsCache[$extractCacheKey]['documentIssues'];
        } else {
            try {
                $elements = $this->extractor->extract($input);
                $documentIssues = $this->extractor->getDocumentIssues();
            } catch (\RuntimeException $exception) {
                return $this->createInvalidDocumentAudit($exception->getMessage(), 0, 'extractor');
            }

            if (\count($elements)) {
                $this->extractedElementsCache[$extractCacheKey] = [
                    'elements' => $elements,
                    'documentIssues' => $documentIssues,
                ];
            }
        }

        if (!\count($elements)) {
            return $this->createInvalidDocumentAudit('No structured data elements could be extracted from the provided document.', 0, 'extractor');
        }

        $types = [];

        foreach ($elements as $jsonLdElement) {
            try {
                /**
                 * @var ArrayStructure|ObjectStructure $parsedJsonLd
                 */
                $parsedJsonLd = $this->parser->parse($jsonLdElement);
            } catch (ParsingException $exception) {
                return $this->createInvalidDocumentAudit($exception->getMessage(), $jsonLdElement->startLine, 'json');
            }

            $validatedTypeTemplatesByElement = null;
            $cacheKey = $this->getValidatedSnippetCacheKey($jsonLdElement);

            if (isset($this->validatedSnippetCache[$cacheKey])) {
                $expansionResult = $this->validatedSnippetCache[$cacheKey]['expandedJsonLd'];
                $validatedTypeTemplatesByElement = $this->validatedSnippetCache[$cacheKey]['validatedTypesByElement'];
            } else {
                try {
                    $expansionResult = $this->expander->expand($jsonLdElement->content, encodeResult: false);
                } catch (JsonLdException $exception) {
                    return $this->createInvalidDocumentAudit($exception->getMessage(), $jsonLdElement->startLine, 'expander');
                }
            }

            if (!\is_array($expansionResult)) {
                return $this->createInvalidDocumentAudit('The JSON-LD document is not valid', $jsonLdElement->startLine, 'expander');
            }

            if ($parsedJsonLd instanceof ArrayStructure) {
                $validatedTypesByElement = [];

                foreach ($parsedJsonLd->getValues() as $index => $jsonLdNode) {
                    /**
                     * @var ObjectStructure $objectStructure
                     */
                    $objectStructure = $jsonLdNode->content;

                    if (null !== $validatedTypeTemplatesByElement) {
                        $validatedTypes = $this->mapJsonLdElement([$expansionResult[$index]], $objectStructure, $jsonLdElement->sourceFormat);
                        $this->applyValidatedTypeTemplates($validatedTypes, $validatedTypeTemplatesByElement[$index] ?? []);
                    } else {
                        $validatedTypes = $this->validateJsonLdElement([$expansionResult[$index]], $objectStructure, $jsonLdElement->sourceFormat);
                        $validatedTypesByElement[$index] = $this->buildValidatedTypeTemplates($validatedTypes);
                    }

                    foreach ($validatedTypes as $validatedType) {
                        $types[] = $validatedType;
                    }
                }

                if (null === $validatedTypeTemplatesByElement) {
                    $this->validatedSnippetCache[$cacheKey] = [
                        'expandedJsonLd' => $expansionResult,
                        'validatedTypesByElement' => $validatedTypesByElement,
                    ];
                }
            } else {
                if (null !== $validatedTypeTemplatesByElement) {
                    $validatedTypes = $this->mapJsonLdElement($expansionResult, $parsedJsonLd, $jsonLdElement->sourceFormat);
                    $this->applyValidatedTypeTemplates($validatedTypes, $validatedTypeTemplatesByElement[0] ?? []);
                } else {
                    $validatedTypes = $this->validateJsonLdElement($expansionResult, $parsedJsonLd, $jsonLdElement->sourceFormat);

                    $this->validatedSnippetCache[$cacheKey] = [
                        'expandedJsonLd' => $expansionResult,
                        'validatedTypesByElement' => [0 => $this->buildValidatedTypeTemplates($validatedTypes)],
                    ];
                }

                foreach ($validatedTypes as $validatedType) {
                    $types[] = $validatedType;
                }
            }
        }

        $documentIssues = $this->mapDocumentIssuesToMappedErrors($documentIssues);

        return new Audit($types, $documentIssues);
    }

    /**
     * @return array<MappedType>
     */
    private function validateJsonLdElement(array $expandedJsonLd, ObjectStructure $parsedJsonLd, ExtractorFormat $sourceFormat): array
    {
        $types = $this->mapJsonLdElement($expandedJsonLd, $parsedJsonLd, $sourceFormat);

        foreach ($types as $type) {
            $this->validateType($type);
        }

        return $types;
    }

    /**
     * @return array<MappedType>
     */
    private function mapJsonLdElement(array $expandedJsonLd, ObjectStructure $parsedJsonLd, ExtractorFormat $sourceFormat): array
    {
        $this->validationMapper->reset();

        return $this->validationMapper->map($expandedJsonLd, $parsedJsonLd, $sourceFormat->value);
    }

    private function createInvalidDocumentAudit(string $message, int $startLine, string $source): Audit
    {
        $documentError = new DocumentError(
            source: ucfirst($source),
            message: $message,
            ranges: \sprintf('line %d', $startLine),
        );

        return new Audit([], $this->mapDocumentIssuesToMappedErrors([$documentError]));
    }

    /**
     * @param array<DocumentIssueInterface> $issues
     *
     * @return array<MappedError>
     */
    private function mapDocumentIssuesToMappedErrors(array $issues): array
    {
        $mappedErrors = [];

        foreach ($issues as $issue) {
            $isError = $issue instanceof DocumentError;
            $severity = $isError ? MappedError::SEVERITY_ERROR : MappedError::SEVERITY_WARNING;

            $mappedErrors[] = new MappedError(
                message: $issue->getMessage(),
                property: null,
                type: null,
                severity: $severity,
                validatorName: $issue->getSource(),
                ranges: $issue->getRanges(),
            );
        }

        return $mappedErrors;
    }

    /**
     * This method will iterate over each type of a property and validate them.
     * A type may contain other types as property values, so it will recursively call itself if some are found.
     */
    private function validateType(MappedType $type, ?MappedProperty $originalProperty = null): void
    {
        if (IriResolver::isAbsoluteIri($type->getType())) {
            return;
        }

        $this->callValidatorsForType($type);

        /**
         * @var MappedProperty $property
         */
        foreach ($type->getProperties() as $property) {
            $propertyValue = $property->getValue();

            if ($propertyValue instanceof MappedType) {
                $this->validateType($propertyValue);

                if (!$propertyValue->isValid()) {
                    $type->setIsValid(false);
                    $property->setIsValid(false);
                }
            } elseif (\is_array($propertyValue)) {
                foreach ($propertyValue as $multipleTypesEntry) {
                    if ($multipleTypesEntry instanceof MappedType) {
                        $this->validateType($multipleTypesEntry);

                        if (!$multipleTypesEntry->isValid()) {
                            $type->setIsValid(false);
                            $property->setIsValid(false);
                        }
                    }
                }
            }

            $this->callValidatorsForProperty($property, $type, $originalProperty);
        }
    }

    private function callValidatorsForType(MappedType $type): void
    {
        if ($this->isTypeReference($type)) {
            return;
        }

        foreach ($this->currentValidators as $validator) {
            $validator->validateType($type);
        }
    }

    private function callValidatorsForProperty(MappedProperty $property, MappedType $type, ?MappedProperty $originalProperty = null): void
    {
        $propertyKey = $property->getKey();

        if ('@' === ($propertyKey[0] ?? '') && Keyword::tryFrom($propertyKey)) {
            return;
        }

        foreach ($this->currentValidators as $validator) {
            $validator->validateProperty($type, $property, $originalProperty);
        }
    }

    private function isTypeReference(MappedType $type): bool
    {
        $properties = $type->getProperties();

        return 1 === \count($properties)
            && Keyword::ID->value === array_key_first($properties)
            && IriResolver::isBlankNodeIdentifier($properties[Keyword::ID->value]->getValue());
    }

    private function getValidatedSnippetCacheKey(JsonLdElement $jsonLdElement): string
    {
        if (null === $this->currentValidatorsSignature) {
            $this->currentValidatorsSignature = implode("\0", array_keys($this->currentValidators));
        }

        return md5(
            $jsonLdElement->sourceFormat->value
            . "\0"
            . $this->currentValidatorsSignature
            . "\0"
            . $jsonLdElement->content,
        );
    }

    /**
     * @param array<MappedType> $types
     *
     * @return array<int, array<string, mixed>>
     */
    private function buildValidatedTypeTemplates(array $types): array
    {
        $templates = [];

        foreach ($types as $type) {
            $templates[] = $this->buildValidatedTypeTemplate($type);
        }

        return $templates;
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
            'documentationLinks' => $type->getDocumentationLinks(),
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
     * @param array<MappedType>                $types
     * @param array<int, array<string, mixed>> $templates
     */
    private function applyValidatedTypeTemplates(array $types, array $templates): void
    {
        foreach ($templates as $index => $template) {
            if (!isset($types[$index])) {
                continue;
            }

            $this->applyValidatedTypeTemplate($types[$index], $template);
        }
    }

    /**
     * @param array<string, mixed> $template
     */
    private function applyValidatedTypeTemplate(MappedType $type, array $template): void
    {
        $type->setDescription($template['description']);
        $type->setIsPartOf($template['isPartOf']);
        $type->setSource($template['source']);

        foreach ($template['documentationLinks'] as $documentationLink) {
            $type->addDocumentationLink($documentationLink);
        }

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
            type: $this->formatTypeLabel($typeWithError->getType()),
            severity: $errorTemplate['severity'],
            validatorName: $errorTemplate['validatorName'],
            ranges: $this->formatRanges($target->getValueRanges()),
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

                $parentType->addChildError($error);
                $parentType = $parentType->getParent();
            }

            return;
        }

        while ($parentType) {
            $parentErrorSeverity = $parentType->getErrorSeverity();

            if (MappedError::SEVERITY_ERROR !== $parentErrorSeverity && $parentErrorSeverity !== $errorSeverity) {
                $parentType->setErrorSeverity($errorSeverity);
            }

            $parentType->addChildError($error);
            $parentType = $parentType->getParent();
        }
    }

    private function formatTypeLabel(string|array|null $typeLabel): ?string
    {
        if (!\is_array($typeLabel)) {
            return $typeLabel;
        }

        if (!isset($typeLabel[1])) {
            return '[' . ($typeLabel[0] ?? '') . ']';
        }

        return '[' . implode(', ', $typeLabel) . ']';
    }

    /**
     * @param array<Range> $ranges
     */
    private function formatRanges(array $ranges): string
    {
        if (!$ranges) {
            return '';
        }

        $formattedRanges = [];

        foreach ($ranges as $range) {
            $startLine = (int) $range->start?->line;
            $startColumn = (int) $range->start?->column;
            $endLine = (int) $range->end?->line;
            $endColumn = (int) $range->end?->column;

            $formattedRanges[] = $startLine . ':' . $startColumn . ' to ' . $endLine . ':' . $endColumn;
        }

        return implode(\PHP_EOL, $formattedRanges);
    }
}
