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

final class TrailerModel
{
    public const DESCRIPTION = 'The trailer of a movie or TV/radio series, season, episode, etc.';
    public const LABEL = 'trailer';
    public const NAME = 'schema:trailer';
    public const VALUES = ['VideoObjectModel' => 'Jolicode\SchemaOrg\Type\VideoObjectModel'];
    public const TYPES = ['CreativeWorkSeason' => 'Jolicode\SchemaOrg\Type\CreativeWorkSeasonModel', 'Episode' => 'Jolicode\SchemaOrg\Type\EpisodeModel', 'Movie' => 'Jolicode\SchemaOrg\Type\MovieModel', 'MovieSeries' => 'Jolicode\SchemaOrg\Type\MovieSeriesModel', 'RadioSeries' => 'Jolicode\SchemaOrg\Type\RadioSeriesModel', 'TVSeries' => 'Jolicode\SchemaOrg\Type\TVSeriesModel', 'VideoGame' => 'Jolicode\SchemaOrg\Type\VideoGameModel', 'VideoGameSeries' => 'Jolicode\SchemaOrg\Type\VideoGameSeriesModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
