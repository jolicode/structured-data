<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class CookTimeModel
{
    public const DESCRIPTION = 'The time it takes to actually cook the dish, in [ISO 8601 duration format](http://en.wikipedia.org/wiki/ISO_8601).';
    public const LABEL = 'cookTime';
    public const NAME = 'schema:cookTime';
    public const VALUES = ['DurationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DurationModel'];
    public const TYPES = ['Recipe' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\RecipeModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
