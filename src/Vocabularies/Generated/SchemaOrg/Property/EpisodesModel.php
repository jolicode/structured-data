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

final class EpisodesModel
{
    public const DESCRIPTION = 'An episode of a TV/radio series or season.';
    public const LABEL = 'episodes';
    public const NAME = 'schema:episodes';
    public const VALUES = ['EpisodeModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\EpisodeModel'];
    public const TYPES = ['CreativeWorkSeason' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkSeasonModel', 'RadioSeries' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\RadioSeriesModel', 'TVSeries' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TVSeriesModel', 'VideoGameSeries' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\VideoGameSeriesModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = 'episode';
}
