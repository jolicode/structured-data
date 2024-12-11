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

final class IngredientsModel
{
    public const DESCRIPTION = 'A single ingredient used in the recipe, e.g. sugar, flour or garlic.';
    public const LABEL = 'ingredients';
    public const NAME = 'schema:ingredients';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Recipe' => 'Jolicode\SchemaOrg\Type\RecipeModel'];
}
