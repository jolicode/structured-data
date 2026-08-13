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

final class SuitableForDietModel
{
    public const DESCRIPTION = 'Indicates a dietary restriction or guideline for which this recipe or menu item is suitable, e.g. diabetic, halal etc.';
    public const LABEL = 'suitableForDiet';
    public const NAME = 'schema:suitableForDiet';
    public const VALUES = ['DietModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DietModel', 'RestrictedDietModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\RestrictedDietModel'];
    public const TYPES = ['MenuItem' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MenuItemModel', 'Recipe' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\RecipeModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
