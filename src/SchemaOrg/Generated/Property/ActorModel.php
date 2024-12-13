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

final class ActorModel
{
    public const DESCRIPTION = 'An actor (individual or a group), e.g. in TV, radio, movie, video games etc., or in an event. Actors can be associated with individual items or with a series, episode, clip.';
    public const LABEL = 'actor';
    public const NAME = 'schema:actor';
    public const VALUES = ['PerformingGroupModel' => 'Jolicode\SchemaOrg\Type\PerformingGroupModel', 'PersonModel' => 'Jolicode\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Clip' => 'Jolicode\SchemaOrg\Type\ClipModel', 'CreativeWorkSeason' => 'Jolicode\SchemaOrg\Type\CreativeWorkSeasonModel', 'Episode' => 'Jolicode\SchemaOrg\Type\EpisodeModel', 'Event' => 'Jolicode\SchemaOrg\Type\EventModel', 'Movie' => 'Jolicode\SchemaOrg\Type\MovieModel', 'MovieSeries' => 'Jolicode\SchemaOrg\Type\MovieSeriesModel', 'PodcastSeries' => 'Jolicode\SchemaOrg\Type\PodcastSeriesModel', 'RadioSeries' => 'Jolicode\SchemaOrg\Type\RadioSeriesModel', 'TVSeries' => 'Jolicode\SchemaOrg\Type\TVSeriesModel', 'VideoGame' => 'Jolicode\SchemaOrg\Type\VideoGameModel', 'VideoGameSeries' => 'Jolicode\SchemaOrg\Type\VideoGameSeriesModel', 'VideoObject' => 'Jolicode\SchemaOrg\Type\VideoObjectModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
