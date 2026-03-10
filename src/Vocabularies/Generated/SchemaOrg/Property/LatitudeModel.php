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

final class LatitudeModel
{
    public const DESCRIPTION = 'The latitude of a location. For example ```37.42242``` ([WGS 84](https://en.wikipedia.org/wiki/World_Geodetic_System)).';
    public const LABEL = 'latitude';
    public const NAME = 'schema:latitude';
    public const VALUES = ['NumberModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\NumberModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['GeoCoordinates' => 'Jolicode\Vocabularies\SchemaOrg\Type\GeoCoordinatesModel', 'Place' => 'Jolicode\Vocabularies\SchemaOrg\Type\PlaceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
