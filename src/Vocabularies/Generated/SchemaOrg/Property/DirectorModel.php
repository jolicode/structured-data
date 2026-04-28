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

final class DirectorModel
{
    public const DESCRIPTION = 'A director of e.g. TV, radio, movie, video gaming etc. content, or of an event. Directors can be associated with individual items or with a series, episode, clip.';
    public const LABEL = 'director';
    public const NAME = 'schema:director';
    public const VALUES = ['PersonModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Clip' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ClipModel', 'CreativeWorkSeason' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkSeasonModel', 'Episode' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\EpisodeModel', 'Event' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\EventModel', 'Movie' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MovieModel', 'MovieSeries' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MovieSeriesModel', 'RadioSeries' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\RadioSeriesModel', 'TVSeries' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TVSeriesModel', 'VideoGame' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\VideoGameModel', 'VideoGameSeries' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\VideoGameSeriesModel', 'VideoObject' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\VideoObjectModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
