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

final class GeoMidpointModel
{
    public const DESCRIPTION = 'Indicates the GeoCoordinates at the centre of a GeoShape, e.g. GeoCircle.';
    public const LABEL = 'geoMidpoint';
    public const NAME = 'schema:geoMidpoint';
    public const VALUES = ['GeoCoordinatesModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\GeoCoordinatesModel'];
    public const TYPES = ['GeoCircle' => 'Jolicode\Vocabularies\SchemaOrg\Type\GeoCircleModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
