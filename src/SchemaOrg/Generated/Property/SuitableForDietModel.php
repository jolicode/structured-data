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

final class SuitableForDietModel
{
    public const DESCRIPTION = 'Indicates a dietary restriction or guideline for which this recipe or menu item is suitable, e.g. diabetic, halal etc.';
    public const LABEL = 'suitableForDiet';
    public const NAME = 'schema:suitableForDiet';
    public const VALUES = ['RestrictedDietModel' => 'Jolicode\SchemaOrg\Type\RestrictedDietModel'];
    public const TYPES = ['MenuItem' => 'Jolicode\SchemaOrg\Type\MenuItemModel', 'Recipe' => 'Jolicode\SchemaOrg\Type\RecipeModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
