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

final class PartOfSeriesModel
{
    public const DESCRIPTION = 'The series to which this episode or season belongs.';
    public const LABEL = 'partOfSeries';
    public const NAME = 'schema:partOfSeries';
    public const VALUES = ['CreativeWorkSeriesModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkSeriesModel'];
    public const TYPES = ['Clip' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ClipModel', 'CreativeWorkSeason' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkSeasonModel', 'Episode' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\EpisodeModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
