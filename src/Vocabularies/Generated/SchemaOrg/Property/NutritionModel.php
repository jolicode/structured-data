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

final class NutritionModel
{
    public const DESCRIPTION = 'Nutrition information about the recipe or menu item.';
    public const LABEL = 'nutrition';
    public const NAME = 'schema:nutrition';
    public const VALUES = ['NutritionInformationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\NutritionInformationModel'];
    public const TYPES = ['MenuItem' => 'Jolicode\Vocabularies\SchemaOrg\Type\MenuItemModel', 'Recipe' => 'Jolicode\Vocabularies\SchemaOrg\Type\RecipeModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
