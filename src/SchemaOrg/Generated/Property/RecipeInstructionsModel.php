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

final class RecipeInstructionsModel
{
    public const DESCRIPTION = 'A step in making the recipe, in the form of a single item (document, video, etc.) or an ordered list with HowToStep and/or HowToSection items.';
    public const LABEL = 'recipeInstructions';
    public const NAME = 'schema:recipeInstructions';
    public const VALUES = ['CreativeWorkModel' => 'Jolicode\SchemaOrg\Type\CreativeWorkModel', 'ItemListModel' => 'Jolicode\SchemaOrg\Type\ItemListModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Recipe' => 'Jolicode\SchemaOrg\Type\RecipeModel'];
}
