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

final class GameLocationModel
{
    public const DESCRIPTION = 'Real or fictional location of the game (or part of game).';
    public const LABEL = 'gameLocation';
    public const NAME = 'schema:gameLocation';
    public const VALUES = ['PlaceModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PlaceModel', 'PostalAddressModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PostalAddressModel', 'URLModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\URLModel'];
    public const TYPES = ['Game' => 'Jolicode\Vocabularies\SchemaOrg\Type\GameModel', 'VideoGameSeries' => 'Jolicode\Vocabularies\SchemaOrg\Type\VideoGameSeriesModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
