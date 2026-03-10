<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class GeoRadiusModel
{
    public const DESCRIPTION = 'Indicates the approximate radius of a GeoCircle (metres unless indicated otherwise via Distance notation).';
    public const LABEL = 'geoRadius';
    public const NAME = 'schema:geoRadius';
    public const VALUES = ['DistanceModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DistanceModel', 'NumberModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\NumberModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['GeoCircle' => 'Jolicode\Vocabularies\SchemaOrg\Type\GeoCircleModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
