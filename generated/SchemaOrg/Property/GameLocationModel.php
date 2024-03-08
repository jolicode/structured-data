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

final class GameLocationModel
{
    public const DESCRIPTION = 'Real or fictional location of the game (or part of game).';
    public const LABEL = 'gameLocation';
    public const NAME = 'schema:gameLocation';
    public const VALUES = ['PlaceModel' => 'SchemaOrg\\Type\\PlaceModel', 'PostalAddressModel' => 'SchemaOrg\\Type\\PostalAddressModel', 'URLModel' => 'SchemaOrg\\Type\\URLModel'];
    public const TYPES = ['Game' => 'SchemaOrg\\Type\\GameModel', 'VideoGameSeries' => 'SchemaOrg\\Type\\VideoGameSeriesModel'];
}
