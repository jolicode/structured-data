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

final class NutritionModel
{
    public const DESCRIPTION = 'Nutrition information about the recipe or menu item.';
    public const LABEL = 'nutrition';
    public const NAME = 'schema:nutrition';
    public const VALUES = ['NutritionInformationModel' => 'SchemaOrg\\Type\\NutritionInformationModel'];
    public const TYPES = ['MenuItem' => 'SchemaOrg\\Type\\MenuItemModel', 'Recipe' => 'SchemaOrg\\Type\\RecipeModel'];
}
