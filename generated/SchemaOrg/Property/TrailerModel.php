<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class TrailerModel
{
    public const DESCRIPTION = 'The trailer of a movie or TV/radio series, season, episode, etc.';
    public const LABEL = 'trailer';
    public const NAME = 'schema:trailer';
    public const VALUES = ['VideoObjectModel' => 'SchemaOrg\Type\VideoObjectModel'];
    public const TYPES = ['CreativeWorkSeason' => 'SchemaOrg\Type\CreativeWorkSeasonModel', 'Episode' => 'SchemaOrg\Type\EpisodeModel', 'Movie' => 'SchemaOrg\Type\MovieModel', 'MovieSeries' => 'SchemaOrg\Type\MovieSeriesModel', 'RadioSeries' => 'SchemaOrg\Type\RadioSeriesModel', 'TVSeries' => 'SchemaOrg\Type\TVSeriesModel', 'VideoGame' => 'SchemaOrg\Type\VideoGameModel', 'VideoGameSeries' => 'SchemaOrg\Type\VideoGameSeriesModel'];
}
