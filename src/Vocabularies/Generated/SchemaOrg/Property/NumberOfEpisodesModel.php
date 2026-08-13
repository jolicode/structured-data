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

final class NumberOfEpisodesModel
{
    public const DESCRIPTION = 'The number of episodes in this season or series.';
    public const LABEL = 'numberOfEpisodes';
    public const NAME = 'schema:numberOfEpisodes';
    public const VALUES = ['IntegerModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\IntegerModel'];
    public const TYPES = ['CreativeWorkSeason' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkSeasonModel', 'RadioSeries' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\RadioSeriesModel', 'TVSeries' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TVSeriesModel', 'VideoGameSeries' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\VideoGameSeriesModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
