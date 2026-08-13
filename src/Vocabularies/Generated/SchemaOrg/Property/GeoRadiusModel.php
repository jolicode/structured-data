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

final class GeoRadiusModel
{
    public const DESCRIPTION = 'Indicates the approximate radius of a GeoCircle (metres unless indicated otherwise via Distance notation).';
    public const LABEL = 'geoRadius';
    public const NAME = 'schema:geoRadius';
    public const VALUES = ['DistanceModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DistanceModel', 'NumberModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\NumberModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['GeoCircle' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\GeoCircleModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
