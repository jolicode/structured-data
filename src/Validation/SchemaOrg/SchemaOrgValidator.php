<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Validation\SchemaOrg;

use Jolicode\JsonLd\Algorithms\Exception\JsonLdException;
use Jolicode\JsonLd\Algorithms\Expand\Expander;
use Jolicode\JsonLd\Algorithms\JsonLd\Keyword;
use Jolicode\JsonLd\Validation\Error\DocumentValidationError;
use Jolicode\JsonLd\Validation\ValidationResult;

/**
 * This class uses expanded JSON-LD documents because it is way simpler.
 */
class SchemaOrgValidator
{
    private const SCHEMA_ORG_DOMAIN = 'http://schema.org/';

    private Type $currentType;

    public function __construct(
        readonly private ValidationResult $validationResult = new ValidationResult(),
    ) {
    }

    public function validate(string $json): ValidationResult
    {
        $expander = new Expander();

        try {
            $expansionResult = $expander->parseJson($json, encodeResult: false);
        } catch (JsonLdException $exception) {
            return new ValidationResult(
                new DocumentValidationError(sprintf(
                    'The JSON-LD document seems invalid. Thrown exception is: %s',
                    $exception
                ))
            );
        }

        foreach ($expansionResult as $type) {
            $this->currentType = new Type();
            $this->validateSchemaOrgType($type);
        }

        return $this->validationResult;
    }

    private function validateSchemaOrgType(\stdClass $type, string $typeShortName = null, string $typeFqcn = null): void
    {
        if (null === $typeShortName) {
            $typeShortName = $this->getTypeShortName($type);
        }

        if (null === $typeFqcn) {
            $typeFqcn = $this->getTypeFqcn($typeShortName);
        }

        if (!$this->validateTypeObject($type, $typeShortName, $typeFqcn)) {
            return;
        }

        $typeModel = new $typeFqcn();
        $this->currentType->label = $typeModel::LABEL;

        foreach ($type as $property => $value) {
            if (Keyword::tryFrom($property)) {
                continue;
            }

            $propertyName = $this->getPropertyName($property);
            $propertyClass = sprintf('SchemaOrg\\Property\\%sModel', ucfirst($propertyName));

            foreach ($value as $valueEntry) {
                $this->validateSchemaOrgProperty($propertyName, $propertyClass, $typeModel, $valueEntry);

                if ($this->isTypeObject($valueEntry)) {
                    $typeShortName = $this->getTypeShortName($valueEntry);
                    $typeFqcn = $this->getTypeFqcn($typeShortName);

                    $propertyType = new Type(belongsTo: $this->currentType);
                    $this->currentType = $propertyType;

                    $this->validateSchemaOrgPropertyType($propertyClass, $typeFqcn, $propertyName);
                    $this->validateSchemaOrgType($valueEntry, $typeShortName, $typeFqcn);
                }
            }
        }
    }

    private function getPropertyName(string $expandedName): string
    {
        return str_replace([self::SCHEMA_ORG_DOMAIN, 'Model'], '', $expandedName);
    }

    private function isTypeObject(\stdClass $entry): bool
    {
        return property_exists($entry, Keyword::TYPE->value);
    }

    private function getTypeShortName(\stdClass $type): ?string
    {
        if (!$this->isTypeObject($type)) {
            return null;
        }

        $typeShortName = \is_array($type->{Keyword::TYPE->value}) ? $type->{Keyword::TYPE->value}[0] : $type->{Keyword::TYPE->value};
        $typeShortName = str_replace(self::SCHEMA_ORG_DOMAIN, '', $typeShortName);

        return $typeShortName;
    }

    private function getTypeFqcn(?string $typeShortName): ?string
    {
        if (null === $typeShortName) {
            return null;
        }

        return sprintf('SchemaOrg\\Type\\%sModel', $typeShortName);
    }

    private function validateTypeObject(\stdClass $type, ?string $typeShortName, ?string $typeFqcn): bool
    {
        if (!$this->isTypeObject($type)) {
            $this->validationResult->addTypeError('This type misses a @type property', Keyword::TYPE->value, $this->currentType);

            return false;
        }

        if (!class_exists($typeFqcn)) {
            $this->validationResult->addTypeError(sprintf('This type is not a valid Schema.org type: %s', $typeShortName), Keyword::TYPE->value, $this->currentType);

            return false;
        }

        return true;
    }

    private function validateSchemaOrgProperty(string $propertyName, string $propertyClass, object $typeModel): void
    {
        if (!class_exists($propertyClass)) {
            $this->validationResult->addTypeError(sprintf('This property does not exist in Schema.org: %s', $propertyName), $propertyName, $this->currentType);

            return;
        }

        if (!property_exists($typeModel, $propertyName)) {
            $this->validationResult->addTypeError(sprintf('The property "%s" does not exist on the type "%s"', $propertyName, $typeModel::LABEL), $propertyName, $this->currentType);
        }
    }

    private function validateSchemaOrgPropertyType(string $propertyClass, string $typeFqcn, string $propertyName): void
    {
        if (!$this->propertyTypeIsValid($propertyClass, $typeFqcn)) {
            $this->validationResult->addTypeError(
                sprintf('The "%s" attribute does not accept the "%s" type as a value', $propertyName, $typeFqcn::LABEL),
                $propertyName,
                $this->currentType
            );
        }
    }

    private function propertyTypeIsValid(string $propertyClass, string $typeFqcn): bool
    {
        if (!\in_array($typeFqcn, $propertyClass::VALUES, true)) {
            foreach ($typeFqcn::PARENTS as $parentType) {
                if ($this->propertyTypeIsValid($propertyClass, $parentType)) {
                    return true;
                }
            }

            return false;
        }

        return true;
    }
}
