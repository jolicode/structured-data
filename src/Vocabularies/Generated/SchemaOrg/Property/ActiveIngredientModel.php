<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class ActiveIngredientModel
{
    public const DESCRIPTION = 'An active ingredient, typically chemical compounds and/or biologic substances.';
    public const LABEL = 'activeIngredient';
    public const NAME = 'schema:activeIngredient';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['DietarySupplement' => 'Jolicode\Vocabularies\SchemaOrg\Type\DietarySupplementModel', 'Drug' => 'Jolicode\Vocabularies\SchemaOrg\Type\DrugModel', 'DrugStrength' => 'Jolicode\Vocabularies\SchemaOrg\Type\DrugStrengthModel', 'Substance' => 'Jolicode\Vocabularies\SchemaOrg\Type\SubstanceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
