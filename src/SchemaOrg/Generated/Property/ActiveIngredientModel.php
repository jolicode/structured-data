<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class ActiveIngredientModel
{
    public const DESCRIPTION = 'An active ingredient, typically chemical compounds and/or biologic substances.';
    public const LABEL = 'activeIngredient';
    public const NAME = 'schema:activeIngredient';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['DietarySupplement' => 'Jolicode\SchemaOrg\Type\DietarySupplementModel', 'Drug' => 'Jolicode\SchemaOrg\Type\DrugModel', 'DrugStrength' => 'Jolicode\SchemaOrg\Type\DrugStrengthModel', 'Substance' => 'Jolicode\SchemaOrg\Type\SubstanceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
