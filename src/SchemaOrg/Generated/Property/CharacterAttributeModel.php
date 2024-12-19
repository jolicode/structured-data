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

final class CharacterAttributeModel
{
    public const DESCRIPTION = 'A piece of data that represents a particular aspect of a fictional character (skill, power, character points, advantage, disadvantage).';
    public const LABEL = 'characterAttribute';
    public const NAME = 'schema:characterAttribute';
    public const VALUES = ['ThingModel' => 'Jolicode\SchemaOrg\Type\ThingModel'];
    public const TYPES = ['Game' => 'Jolicode\SchemaOrg\Type\GameModel', 'VideoGameSeries' => 'Jolicode\SchemaOrg\Type\VideoGameSeriesModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
