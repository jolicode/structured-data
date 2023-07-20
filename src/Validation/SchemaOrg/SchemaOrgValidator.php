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
    private array $typesStack = [];

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

        if (\count($expansionResult) > 1) {
            $this->validationResult->setHasAGraph(true);
        }

        foreach ($expansionResult as $type) {
            $this->validateSchemaOrgType($type);

            if ($this->validationResult->hasAGraph()) {
                $this->validationResult->incrementGraphKey();
            }
        }

        return $this->validationResult;
    }

    /**
     * Validates that a type is a correct Schema.org type.
     */
    private function validateSchemaOrgType(\stdClass $type, string $typeShortName = null, string $typeFqcn = null): void
    {
        if (!$typeModel = $this->validateAndInstantiateType($type, $typeShortName, $typeFqcn)) {
            return;
        }

        foreach ($type as $property => $value) {
            if (Keyword::tryFrom($property)) {
                continue;
            }

            $propertyLabel = $this->getPropertyName($property);
            $propertyClass = sprintf('SchemaOrg\\Property\\%sModel', ucfirst($propertyLabel));

            foreach ($value as $key => $valueEntry) {
                $this->validateSchemaOrgProperty($propertyLabel, $propertyClass, $typeModel, $valueEntry);

                if ($this->isTypeObject($valueEntry)) {
                    $typeShortName = $this->getTypeShortName($valueEntry);
                    $typeFqcn = $this->getTypeFqcn($typeShortName);

                    $this->validateSchemaOrgPropertyType($propertyClass, $typeFqcn, $propertyLabel);

                    if (\count($value) > 1) {
                        // TODO: this is working with our tests but I'm not sure this is actually ok. We should review this and test it more;
                        $this->typesStack[$propertyLabel][] = $propertyLabel;
                    } else {
                        // TODO: this is working with our tests but I'm not sure this is actually ok. We should review this and test it more;
                        $this->typesStack[] = $propertyLabel;
                    }

                    $this->validateSchemaOrgType($valueEntry, $typeShortName, $typeFqcn);

                    if (\count($value) > 1 && $key !== array_key_last($value)) {
                        continue;
                    }

                    array_pop($this->typesStack);
                }
            }
        }
    }

    private function validateAndInstantiateType(\stdClass $type, ?string $typeShortName, ?string $typeFqcn): object|false
    {
        if (!$this->isTypeObject($type)) {
            $this->validationResult->addTypeError('This type misses a @type property', null, $this->typesStack);

            return false;
        }

        if (null === $typeShortName) {
            $typeShortName = $this->getTypeShortName($type);
        }

        if (null === $typeFqcn) {
            $typeFqcn = $this->getTypeFqcn($typeShortName);
        }

        if (!class_exists($typeFqcn)) {
            $this->validationResult->addTypeError(sprintf('This type is not a valid Schema.org type: %s', $typeShortName), Keyword::TYPE->value, $this->typesStack);

            return false;
        }

        return new $typeFqcn();
    }

    private function getPropertyName(string $expandedName): string
    {
        return str_replace([self::SCHEMA_ORG_DOMAIN, 'Model'], '', $expandedName);
    }

    private function isTypeObject(\stdClass $entry): bool
    {
        return property_exists($entry, Keyword::TYPE->value);
    }

    private function getTypeShortName(\stdClass $type): string
    {
        $typeShortName = \is_array($type->{Keyword::TYPE->value}) ? $type->{Keyword::TYPE->value}[0] : $type->{Keyword::TYPE->value};
        $typeShortName = str_replace(self::SCHEMA_ORG_DOMAIN, '', $typeShortName);

        return $typeShortName;
    }

    private function getTypeFqcn(string $typeShortName): string
    {
        return sprintf('SchemaOrg\\Type\\%sModel', $typeShortName);
    }

    /**
     * Verifies that a property exists and is a valid property for the given type.
     */
    private function validateSchemaOrgProperty(string $propertyLabel, string $propertyClass, object $typeModel, \stdClass $propertyValue): void
    {
        if (!class_exists($propertyClass)) {
            $this->validationResult->addTypeError(sprintf('This property does not exist in Schema.org: %s', $propertyLabel), $propertyLabel, $this->typesStack);

            return;
        }

        if (!property_exists($typeModel, $propertyLabel)) {
            $this->validationResult->addTypeError(sprintf('The property "%s" does not exist on the type "%s" in Schema.org', $propertyLabel, $typeModel::LABEL), $propertyLabel, $this->typesStack);
        }
    }

    /**
     * Verifies that a nested type is a valid type for the given property.
     */
    private function validateSchemaOrgPropertyType(string $propertyClass, string $typeFqcn, string $propertyLabel): void
    {
        if (!$this->propertyTypeIsValid($propertyClass, $typeFqcn)) {
            $this->validationResult->addTypeError(
                sprintf('The "%s" attribute does not accept the "%s" type as a value in Schema.org', $propertyLabel, $typeFqcn::LABEL),
                $propertyLabel,
                $this->typesStack
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
