<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class ActiveIngredientModel
{
    public const DESCRIPTION = 'An active ingredient, typically chemical compounds and/or biologic substances.';
    public const LABEL = 'activeIngredient';
    public const NAME = 'schema:activeIngredient';
    public const VALUES = ['TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['DietarySupplement' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DietarySupplementModel', 'Drug' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DrugModel', 'DrugStrength' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DrugStrengthModel', 'Substance' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\SubstanceModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
