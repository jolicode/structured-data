<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class ActiveIngredientModel
{
    public const DESCRIPTION = 'An active ingredient, typically chemical compounds and/or biologic substances.';
    public const LABEL = 'activeIngredient';
    public const NAME = 'schema:activeIngredient';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['DietarySupplement' => 'SchemaOrg\\Type\\DietarySupplementModel', 'Drug' => 'SchemaOrg\\Type\\DrugModel', 'DrugStrength' => 'SchemaOrg\\Type\\DrugStrengthModel', 'Substance' => 'SchemaOrg\\Type\\SubstanceModel'];
}
