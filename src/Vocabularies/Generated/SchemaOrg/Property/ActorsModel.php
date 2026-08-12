<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class ActorsModel
{
    public const DESCRIPTION = 'An actor, e.g. in TV, radio, movie, video games etc. Actors can be associated with individual items or with a series, episode, clip.';
    public const LABEL = 'actors';
    public const NAME = 'schema:actors';
    public const VALUES = ['PersonModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Clip' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ClipModel', 'Episode' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\EpisodeModel', 'Movie' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MovieModel', 'MovieSeries' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MovieSeriesModel', 'RadioSeries' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\RadioSeriesModel', 'TVSeries' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TVSeriesModel', 'VideoGame' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\VideoGameModel', 'VideoGameSeries' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\VideoGameSeriesModel', 'VideoObject' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\VideoObjectModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = 'actor';
}
