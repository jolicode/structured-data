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

final class SeasonModel
{
    public const DESCRIPTION = 'A season in a media series.';
    public const LABEL = 'season';
    public const NAME = 'schema:season';
    public const VALUES = ['CreativeWorkSeasonModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkSeasonModel', 'URLModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\URLModel'];
    public const TYPES = ['RadioSeries' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\RadioSeriesModel', 'TVSeries' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TVSeriesModel', 'VideoGameSeries' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\VideoGameSeriesModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = 'containsSeason';
}
