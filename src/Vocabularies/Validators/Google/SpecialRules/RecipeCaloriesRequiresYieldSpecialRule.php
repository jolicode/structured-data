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

use Jolicode\Vocabularies\Mapper\MappedError;
use Jolicode\Vocabularies\Mapper\MappedType;

final class RecipeCaloriesRequiresYieldSpecialRule implements SpecialRuleInterface
{
    public static function getKey(): string
    {
        return 'google.recipe.calories_requires_yield';
    }

    public function shouldIgnoreMissingRequiredProperty(MappedType $type, array $missingProperty): bool
    {
        return false;
    }

    public function shouldIgnoreMissingRecommendedProperty(MappedType $type, array $missingProperty): bool
    {
        if ('recipeYield' !== ($missingProperty['name'] ?? null)) {
            return false;
        }

        if (!$this->hasType($type->type, 'Recipe')) {
            return false;
        }

        $nutrition = $type->properties['nutrition']->value ?? null;

        if (!$nutrition instanceof MappedType) {
            return false;
        }

        return \array_key_exists('calories', $nutrition->properties);
    }

    public function getTypeViolations(MappedType $type): array
    {
        if (!$this->hasType($type->type, 'Recipe')) {
            return [];
        }

        $nutrition = $type->properties['nutrition']->value ?? null;

        if (!$nutrition instanceof MappedType) {
            return [];
        }

        if (!\array_key_exists('calories', $nutrition->properties)) {
            return [];
        }

        if (\array_key_exists('recipeYield', $type->properties)) {
            return [];
        }

        return [[
            'target' => $type,
            'message' => 'Advisory: when "nutrition.calories" is provided, include "recipeYield" so calories are interpreted per serving.',
            'severity' => MappedError::SEVERITY_WARNING,
        ]];
    }

    private function hasType(string|array|null $type, string $searchedType): bool
    {
        if (\is_array($type)) {
            return \in_array($searchedType, $type, true);
        }

        return $searchedType === $type;
    }
}
