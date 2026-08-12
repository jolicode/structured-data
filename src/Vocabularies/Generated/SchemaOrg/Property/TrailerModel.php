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

final class TrailerModel
{
    public const DESCRIPTION = 'The trailer of a movie or TV/radio series, season, episode, etc.';
    public const LABEL = 'trailer';
    public const NAME = 'schema:trailer';
    public const VALUES = ['VideoObjectModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\VideoObjectModel'];
    public const TYPES = ['CreativeWorkSeason' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkSeasonModel', 'Episode' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\EpisodeModel', 'Movie' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MovieModel', 'MovieSeries' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MovieSeriesModel', 'RadioSeries' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\RadioSeriesModel', 'TVSeries' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TVSeriesModel', 'VideoGame' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\VideoGameModel', 'VideoGameSeries' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\VideoGameSeriesModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
