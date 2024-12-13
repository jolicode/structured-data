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

final class RecipeModel
{
    public const DESCRIPTION = 'A sub property of instrument. The recipe/instructions used to perform the action.';
    public const LABEL = 'recipe';
    public const NAME = 'schema:recipe';
    public const VALUES = ['RecipeModel' => 'Jolicode\SchemaOrg\Type\RecipeModel'];
    public const TYPES = ['CookAction' => 'Jolicode\SchemaOrg\Type\CookActionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
