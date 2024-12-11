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

final class GeoRadiusModel
{
    public const DESCRIPTION = 'Indicates the approximate radius of a GeoCircle (metres unless indicated otherwise via Distance notation).';
    public const LABEL = 'geoRadius';
    public const NAME = 'schema:geoRadius';
    public const VALUES = ['DistanceModel' => 'Jolicode\SchemaOrg\Type\DistanceModel', 'NumberModel' => 'Jolicode\SchemaOrg\Type\NumberModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['GeoCircle' => 'Jolicode\SchemaOrg\Type\GeoCircleModel'];
}
