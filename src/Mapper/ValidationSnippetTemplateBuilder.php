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

/**
 * Serializes the validation outcome of a mapped type tree into the plain-array
 * templates the snippet cache stores.
 *
 * Mirror image of ValidationSnippetTemplateApplier: the two must stay in sync.
 */
final class ValidationSnippetTemplateBuilder
{
    /**
     * @param array<MappedType> $types
     *
     * @return array<int, array<string, mixed>>
     */
    public static function buildValidatedTypeTemplates(array $types): array
    {
        $templates = [];

        foreach ($types as $type) {
            $templates[] = self::buildValidatedTypeTemplate($type);
        }

        return $templates;
    }

    /**
     * @return array<string, mixed>
     */
    private static function buildValidatedTypeTemplate(MappedType $type): array
    {
        $properties = [];

        foreach ($type->getProperties() as $name => $property) {
            $properties[$name] = self::buildValidatedPropertyTemplate($property);
        }

        return [
            'description' => $type->getDescription(),
            'isPartOf' => $type->getIsPartOf(),
            'source' => $type->getSource(),
            'documentationLink' => $type->getDocumentationLink(),
            'errors' => self::buildErrorTemplates($type->getErrors()),
            'properties' => $properties,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private static function buildValidatedPropertyTemplate(MappedProperty $property): array
    {
        $nestedType = null;
        $nestedTypes = [];
        $propertyValue = $property->getValue();

        if ($propertyValue instanceof MappedType) {
            $nestedType = self::buildValidatedTypeTemplate($propertyValue);
        } elseif (\is_array($propertyValue)) {
            foreach ($propertyValue as $key => $entry) {
                if ($entry instanceof MappedType) {
                    $nestedTypes[$key] = self::buildValidatedTypeTemplate($entry);
                }
            }
        }

        return [
            'description' => $property->getDescription(),
            'isPartOf' => $property->getIsPartOf(),
            'source' => $property->getSource(),
            'errors' => self::buildErrorTemplates($property->getErrors()),
            'nestedType' => $nestedType,
            'nestedTypes' => $nestedTypes,
        ];
    }

    /**
     * @param array<MappedError> $errors
     *
     * @return array<int, array{message: string, severity: string, validatorName: ?string}>
     */
    private static function buildErrorTemplates(array $errors): array
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
}
