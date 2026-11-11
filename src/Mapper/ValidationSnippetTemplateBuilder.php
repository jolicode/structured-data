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
 * Serializes the validation outcome of a mapped type tree into the templates
 * the snippet cache stores.
 *
 * Mirror image of ValidationSnippetTemplateApplier: the two must stay in sync.
 */
final class ValidationSnippetTemplateBuilder
{
    /**
     * @param array<MappedType> $types
     *
     * @return list<ValidatedTypeTemplate>
     */
    public static function buildValidatedTypeTemplates(array $types): array
    {
        $templates = [];

        foreach ($types as $type) {
            $templates[] = self::buildValidatedTypeTemplate($type);
        }

        return $templates;
    }

    private static function buildValidatedTypeTemplate(MappedType $type): ValidatedTypeTemplate
    {
        $properties = [];

        foreach ($type->getProperties() as $name => $property) {
            $properties[$name] = self::buildValidatedPropertyTemplate($property);
        }

        return new ValidatedTypeTemplate(
            description: $type->getDescription(),
            isPartOf: $type->getIsPartOf(),
            source: $type->getSource(),
            documentationLink: $type->getDocumentationLink(),
            errors: self::buildErrorTemplates($type->getErrors()),
            properties: $properties,
        );
    }

    private static function buildValidatedPropertyTemplate(MappedProperty $property): ValidatedPropertyTemplate
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

        return new ValidatedPropertyTemplate(
            description: $property->getDescription(),
            isPartOf: $property->getIsPartOf(),
            source: $property->getSource(),
            errors: self::buildErrorTemplates($property->getErrors()),
            nestedType: $nestedType,
            nestedTypes: $nestedTypes,
        );
    }

    /**
     * @param array<MappedError> $errors
     *
     * @return list<MappedErrorTemplate>
     */
    private static function buildErrorTemplates(array $errors): array
    {
        $templates = [];

        foreach ($errors as $error) {
            $templates[] = new MappedErrorTemplate(
                message: $error->getMessage(),
                severity: $error->getSeverity(),
                validatorName: $error->getValidatorName(),
                documentationLink: $error->getDocumentationLink(),
            );
        }

        return $templates;
    }
}
