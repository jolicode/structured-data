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
 * Replays a cached validation outcome onto a freshly mapped type tree.
 *
 * Mirror image of ValidationSnippetTemplateBuilder: the two must stay in sync.
 */
final class ValidationSnippetTemplateApplier
{
    /**
     * @param array<MappedType>                $types
     * @param array<int, array<string, mixed>> $templates
     */
    public static function applyValidatedTypeTemplates(array $types, array $templates): void
    {
        foreach ($templates as $index => $template) {
            if (!isset($types[$index])) {
                continue;
            }

            self::applyValidatedTypeTemplate($types[$index], $template);
        }
    }

    /**
     * @param array<string, mixed> $template
     */
    private static function applyValidatedTypeTemplate(MappedType $type, array $template): void
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

            self::applyValidatedPropertyTemplate($property, $type, $propertyTemplate);
        }

        foreach ($template['errors'] as $errorTemplate) {
            self::replayMappedError($type, $type, $errorTemplate);
        }
    }

    /**
     * @param array<string, mixed> $template
     */
    private static function applyValidatedPropertyTemplate(MappedProperty $property, MappedType $ownerType, array $template): void
    {
        $property->setDescription($template['description']);
        $property->addIsPartOf($template['isPartOf']);
        $property->addSource($template['source']);
        $value = $property->getValue();

        if (null !== $template['nestedType'] && $value instanceof MappedType) {
            self::applyValidatedTypeTemplate($value, $template['nestedType']);
        }

        if (\is_array($value)) {
            foreach ($template['nestedTypes'] as $key => $nestedTemplate) {
                $nestedValue = $value[$key] ?? null;

                if ($nestedValue instanceof MappedType) {
                    self::applyValidatedTypeTemplate($nestedValue, $nestedTemplate);
                }
            }
        }

        foreach ($template['errors'] as $errorTemplate) {
            self::replayMappedError($property, $ownerType, $errorTemplate);
        }
    }

    /**
     * @param array{message: string, severity: string, validatorName: ?string} $errorTemplate
     */
    private static function replayMappedError(MappedType|MappedProperty $target, MappedType $typeWithError, array $errorTemplate): void
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
