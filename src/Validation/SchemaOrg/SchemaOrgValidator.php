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
use Jolicode\JsonLd\Validation\ValidationError;
use Jolicode\JsonLd\Validation\ValidationResult;

/**
 * This class uses expanded JSON-LD documents because it is way simpler.
 */
class SchemaOrgValidator
{
    private const SCHEMA_ORG_DOMAIN = 'http://schema.org/';

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
                new ValidationError(sprintf(
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

    private function validateJsonLdType(\stdClass $type): void
    {
        if (!$typeModel = $this->getTypeModel($type)) {
            return;
        }

        foreach ($type as $key => $value) {
            if (Keyword::tryFrom($key)) {
                continue;
            }

            $keyProperty = str_replace(self::SCHEMA_ORG_DOMAIN, '', $key);
            $this->validatePropertyExists($keyProperty, $typeModel);

            if (property_exists($value[0], Keyword::TYPE->value)) {
                $this->validateJsonLdType($value[0]);
            }
        }
    }

    private function getTypeModel(\stdClass $type): false|object
    {
        if (!property_exists($type, Keyword::TYPE->value)) {
            $this->validationResult->addError('This type misses a @type property', $type);

            return false;
        }

        $typeShortName = \is_array($type->{Keyword::TYPE->value}) ? $type->{Keyword::TYPE->value}[0] : $type->{Keyword::TYPE->value};
        $typeShortName = str_replace(self::SCHEMA_ORG_DOMAIN, '', $typeShortName);
        $typeFqcn = sprintf('SchemaOrg\\Type\\%sModel', $typeShortName);

        if (!class_exists($typeFqcn)) {
            $this->validationResult->addError(sprintf('This type is not a valid Schema.org type: %s', $typeShortName), $type);

            return false;
        }

        return new $typeFqcn();
    }

    private function validatePropertyExists(string $keyProperty, object $typeModel): void
    {
        if (!property_exists($typeModel, $keyProperty)) {
            $propertyClass = sprintf('SchemaOrg\\Property\\%sModel', ucfirst($keyProperty));

            if (!class_exists($propertyClass)) {
                $this->validationResult->addError(sprintf('This property does not exist in Schema.org: %s', $keyProperty), $typeModel);

                return;
            }

            if (!$this->climbParentsTree($typeModel, $propertyClass)) {
                $this->validationResult->addError(sprintf('This type uses an inexistant property: %s', $keyProperty), $typeModel);

                return;
            }
        }
    }

    private function climbParentsTree(object $typeModel, string $propertyClass): bool
    {
        foreach ($propertyClass::POSSIBLE_PARENTS as $shortName => $fqcn) {
            if (property_exists($typeModel, lcfirst($shortName))) {
                return true;
            }

            if ($this->climbParentsTree($typeModel, $fqcn)) {
                return true;
            }
        }

        return false;
    }
}
