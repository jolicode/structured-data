<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Validators\Google\SpecialRules;

use Jolicode\JsonLd\Mapper\MappedType;

interface SpecialRuleInterface
{
    public static function getKey(): string;

    public function shouldIgnoreMissingRequiredProperty(MappedType $type, array $missingProperty): bool;

    public function shouldIgnoreMissingRecommendedProperty(MappedType $type, array $missingProperty): bool;

    /**
     * @return array<int, array{target: MappedType|\Jolicode\JsonLd\Mapper\MappedProperty, message: string, severity: string}>
     */
    public function getTypeViolations(MappedType $type): array;
}
