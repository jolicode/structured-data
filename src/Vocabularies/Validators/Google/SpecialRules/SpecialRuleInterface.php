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

use JoliCode\StructuredData\Mapper\MappedType;

interface SpecialRuleInterface
{
    public static function getKey(): string;

    public function shouldIgnoreMissingRequiredProperty(MappedType $type, array $missingProperty): bool;

    public function shouldIgnoreMissingRecommendedProperty(MappedType $type, array $missingProperty): bool;

    /**
     * @return array<int, array{target: MappedType|\JoliCode\StructuredData\Mapper\MappedProperty, message: string, severity: string}>
     */
    public function getTypeViolations(MappedType $type): array;
}
