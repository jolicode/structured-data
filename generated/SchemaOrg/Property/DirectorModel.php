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

final class DirectorModel
{
    public const DESCRIPTION = 'A director of e.g. TV, radio, movie, video gaming etc. content, or of an event. Directors can be associated with individual items or with a series, episode, clip.';
    public const LABEL = 'director';
    public const NAME = 'schema:director';
    public const VALUES = ['PersonModel' => 'SchemaOrg\\Type\\PersonModel'];
    public const TYPES = ['Clip' => 'SchemaOrg\\Type\\ClipModel', 'CreativeWorkSeason' => 'SchemaOrg\\Type\\CreativeWorkSeasonModel', 'Episode' => 'SchemaOrg\\Type\\EpisodeModel', 'Event' => 'SchemaOrg\\Type\\EventModel', 'Movie' => 'SchemaOrg\\Type\\MovieModel', 'MovieSeries' => 'SchemaOrg\\Type\\MovieSeriesModel', 'RadioSeries' => 'SchemaOrg\\Type\\RadioSeriesModel', 'TVSeries' => 'SchemaOrg\\Type\\TVSeriesModel', 'VideoGame' => 'SchemaOrg\\Type\\VideoGameModel', 'VideoGameSeries' => 'SchemaOrg\\Type\\VideoGameSeriesModel', 'VideoObject' => 'SchemaOrg\\Type\\VideoObjectModel'];
}
