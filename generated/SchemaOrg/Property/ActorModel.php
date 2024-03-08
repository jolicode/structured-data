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

final class ActorModel
{
    public const DESCRIPTION = 'An actor, e.g. in TV, radio, movie, video games etc., or in an event. Actors can be associated with individual items or with a series, episode, clip.';
    public const LABEL = 'actor';
    public const NAME = 'schema:actor';
    public const VALUES = ['PersonModel' => 'SchemaOrg\\Type\\PersonModel'];
    public const TYPES = ['Clip' => 'SchemaOrg\\Type\\ClipModel', 'CreativeWorkSeason' => 'SchemaOrg\\Type\\CreativeWorkSeasonModel', 'Episode' => 'SchemaOrg\\Type\\EpisodeModel', 'Event' => 'SchemaOrg\\Type\\EventModel', 'Movie' => 'SchemaOrg\\Type\\MovieModel', 'MovieSeries' => 'SchemaOrg\\Type\\MovieSeriesModel', 'PodcastSeries' => 'SchemaOrg\\Type\\PodcastSeriesModel', 'RadioSeries' => 'SchemaOrg\\Type\\RadioSeriesModel', 'TVSeries' => 'SchemaOrg\\Type\\TVSeriesModel', 'VideoGame' => 'SchemaOrg\\Type\\VideoGameModel', 'VideoGameSeries' => 'SchemaOrg\\Type\\VideoGameSeriesModel', 'VideoObject' => 'SchemaOrg\\Type\\VideoObjectModel'];
}
