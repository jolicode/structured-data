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

use Jolicode\JsonLd\Algorithms\JsonLd\Keyword;
use Jolicode\JsonLd\Parser\SourceMap;
use Jolicode\JsonLd\Validation\ValidationResult;

/**
 * This class uses expanded JSON-LD documents because it is way simpler.
 */
class SchemaOrgValidator
{
    /**
     * @param array<string, \stdClass> $expandedJson
     */
    public function validate(array $expandedJson, SourceMap $sourceMap): ValidationResult
    {
        dd(expandedJson: $expandedJson, sourceMap: $sourceMap->keyRanges);

        $validationResult = new ValidationResult();

        // foreach ($document as $type) {
        //     $this->validateEntry($type, $validationResult);
        // }

        return $validationResult;
    }

    private function validateEntry(\stdClass $jsonType, ValidationResult $validationResult): void
    {
        if (!property_exists($jsonType, Keyword::TYPE->value)) {
            $validationResult->addError('A type is invalid: it does not have a @type entry');

            return;
        }

        if (!$phpType = $this->getType($jsonType->{Keyword::TYPE->value}[0])) {
            $validationResult->addError('A type is invalid: the type is not a valid Schema.org type');

            return;
        }

        $validationResult->setType($phpType);

        foreach ($jsonType as $identifier => $value) {
            if (Keyword::tryFrom($identifier)) {
                continue;
            }

            $identifier = $this->getProperty($identifier);

            $phpType->{$identifier::LABEL} = $identifier;
        }
    }

    private function getType(string $type): ?object
    {
        $type = preg_replace('/^.*\//', '', $type);
        $fqcn = sprintf('SchemaOrg\Type\%sModel', ucfirst($type));

        if (!class_exists($fqcn)) {
            return null;
        }

        return new $fqcn();
    }

    private function getProperty(string $property): ?object
    {
        $property = preg_replace('/^.*\//', '', $property);
        $fqcn = sprintf('SchemaOrg\Property\%sModel', ucfirst($property));

        if (!class_exists($fqcn)) {
            return null;
        }

        return new $fqcn();
    }

    private function getEnumerationMember(string $enumerationMember): ?object
    {
        $enumerationMember = preg_replace('/^.*#/', '', $enumerationMember);
        $fqcn = sprintf('SchemaOrg\EnumerationMember\%sModel', ucfirst($enumerationMember));

        if (!class_exists($fqcn)) {
            return null;
        }

        return new $fqcn();
    }
}
