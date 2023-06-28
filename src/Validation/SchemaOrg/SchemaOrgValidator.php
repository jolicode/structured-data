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

    /**
     * @var string[]
     */
    private array $ascendantsKeys = [];

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
            $this->validateJsonLdType($type);
        }

        return $this->validationResult;
    }

    private function validateJsonLdType(\stdClass $type, string $attributeKey = null): void
    {
        if (!$typeModel = $this->getTypeModel($type, validateType: true)) {
            return;
        }

        $ascendantAlreadyDeclared = false;

        foreach ($type as $key => $value) {
            if (Keyword::tryFrom($key)) {
                continue;
            }

            $propertyName = $this->getPropertyName($key);
            $propertyClass = sprintf('SchemaOrg\\Property\\%sModel', ucfirst($propertyName));

            $this->validateProperty($propertyName, $propertyClass, $typeModel, $value[0]);

            if ($this->isTypeObject($value[0])) {
                if ($attributeKey && !$ascendantAlreadyDeclared) {
                    $ascendantAlreadyDeclared = true;
                    array_unshift($this->ascendantsKeys, $this->getPropertyName($attributeKey));
                }

                $this->validateJsonLdType($value[0], $key);
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

    private function getTypeModel(\stdClass $type, bool $validateType = false): false|object
    {
        if (!$this->isTypeObject($type)) {
            if ($validateType) {
                $this->validationResult->addTypeError('This type misses a @type property', Keyword::TYPE->value, $this->ascendantsKeys);
            }

            return false;
        }

        $typeShortName = \is_array($type->{Keyword::TYPE->value}) ? $type->{Keyword::TYPE->value}[0] : $type->{Keyword::TYPE->value};
        $typeShortName = str_replace(self::SCHEMA_ORG_DOMAIN, '', $typeShortName);
        $typeFqcn = sprintf('SchemaOrg\\Type\\%sModel', $typeShortName);

        if (!class_exists($typeFqcn)) {
            if ($validateType) {
                $this->validationResult->addTypeError(sprintf('This type is not a valid Schema.org type: %s', $typeShortName), Keyword::TYPE->value, $this->ascendantsKeys);
            }

            return false;
        }

        return new $typeFqcn();
    }

    private function validateProperty(string $propertyName, string $propertyClass, object $typeModel, \stdClass $propertyValue): void
    {
        if ($this->isTypeObject($propertyValue)) {
            // If the type is invalid, we cannot validate it. We do nothing here because the validation errors will be added by the validateJsonLdType method.
            if ($nestedType = $this->getTypeModel($propertyValue)) {
                if (!$this->propertyTypeIsValid($propertyClass, $nestedType)) {
                    $this->validationResult->addTypeError(
                        sprintf('The "%s" attribute does not accept the "%s" type as a value', $propertyName, $nestedType::LABEL),
                        $propertyName,
                        $this->ascendantsKeys
                    );
                }
            }
        }

        if (!class_exists($propertyClass)) {
            $this->validationResult->addTypeError(sprintf('This property does not exist in Schema.org: %s', $propertyName), $propertyName, $this->ascendantsKeys);
        }

        if (!$this->propertyExistsOnType($propertyName, $typeModel)) {
            $this->validationResult->addTypeError(sprintf('The property "%s" does not exist on the type "%s"', $propertyName, $typeModel::LABEL), $propertyName, $this->ascendantsKeys);
        }
    }

    private function propertyTypeIsValid(string $propertyClass, object $typeModel): bool
    {
        if (!\in_array($typeModel::class, $propertyClass::VALUES, true)) {
            foreach ($typeModel::PARENTS as $parent) {
                if ($this->propertyTypeIsValid($propertyClass, new $parent())) {
                    return true;
                }
            }

            return false;
        }

        return true;
    }

    private function propertyExistsOnType(string $propertyName, object $typeModel): bool
    {
        if (!property_exists($typeModel, $propertyName)) {
            foreach ($typeModel::PARENTS as $parent) {
                if ($this->propertyExistsOnType($propertyName, new $parent())) {
                    return true;
                }
            }

            return false;
        }

        return true;
    }
}
