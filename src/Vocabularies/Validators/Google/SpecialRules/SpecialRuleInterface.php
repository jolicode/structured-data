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

use JoliCode\StructuredData\Mapper\MappedProperty;
use JoliCode\StructuredData\Mapper\MappedType;
use JoliCode\StructuredData\Vocabularies\Validators\Google\ValidationPropertiesNormalizer;

/**
 * @phpstan-import-type ValidationProperty from ValidationPropertiesNormalizer
 */
interface SpecialRuleInterface
{
    public static function getKey(): string;

    /**
     * @param ValidationProperty $missingProperty
     */
    public function shouldIgnoreMissingRequiredProperty(MappedType $type, array $missingProperty): bool;

    /**
     * @param ValidationProperty $missingProperty
     */
    public function shouldIgnoreMissingRecommendedProperty(MappedType $type, array $missingProperty): bool;

    /**
     * @return array<int, array{target: MappedType|MappedProperty, message: string, severity: string, documentation?: string}>
     */
    public function getTypeViolations(MappedType $type): array;
}
