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

final class GameLocationModel
{
    public const DESCRIPTION = 'Real or fictional location of the game (or part of game).';
    public const LABEL = 'gameLocation';
    public const NAME = 'schema:gameLocation';
    public const VALUES = ['PlaceModel' => 'Jolicode\SchemaOrg\Type\PlaceModel', 'PostalAddressModel' => 'Jolicode\SchemaOrg\Type\PostalAddressModel', 'URLModel' => 'Jolicode\SchemaOrg\Type\URLModel'];
    public const TYPES = ['Game' => 'Jolicode\SchemaOrg\Type\GameModel', 'VideoGameSeries' => 'Jolicode\SchemaOrg\Type\VideoGameSeriesModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
