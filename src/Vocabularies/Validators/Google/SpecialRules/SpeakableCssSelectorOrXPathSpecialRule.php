<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Validators\Google\SpecialRules;

use JoliCode\StructuredData\Mapper\MappedError;
use JoliCode\StructuredData\Mapper\MappedProperty;
use JoliCode\StructuredData\Mapper\MappedType;

final class SpeakableCssSelectorOrXPathSpecialRule implements SpecialRuleInterface
{
    public static function getKey(): string
    {
        return 'google.speakable.cssselector_or_xpath';
    }

    public function shouldIgnoreMissingRequiredProperty(MappedType $type, array $missingProperty): bool
    {
        return false;
    }

    public function shouldIgnoreMissingRecommendedProperty(MappedType $type, array $missingProperty): bool
    {
        return false;
    }

    public function getTypeViolations(MappedType $type): array
    {
        if (!$this->hasType($type->getType(), 'SpeakableSpecification')) {
            return [];
        }

        $hasCssSelector = $this->hasNonEmptyValue($type->getProperties()['cssSelector'] ?? null);
        $hasXPath = $this->hasNonEmptyValue($type->getProperties()['xPath'] ?? null);

        if ($hasCssSelector xor $hasXPath) {
            return [];
        }

        return [[
            'target' => $type,
            'message' => 'A "SpeakableSpecification" must define exactly one of "cssSelector" or "xPath".',
            'severity' => MappedError::SEVERITY_ERROR,
        ]];
    }

    private function hasType(string|array|null $type, string $searchedType): bool
    {
        if (\is_array($type)) {
            return \in_array($searchedType, $type, true);
        }

        return $searchedType === $type;
    }

    private function hasNonEmptyValue(?MappedProperty $property): bool
    {
        if (!$property instanceof MappedProperty) {
            return false;
        }

        $value = $property->getValue();

        if (\is_array($value)) {
            return [] !== $value;
        }

        return null !== $value;
    }
}
