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

final class GeoModel
{
    public const DESCRIPTION = 'The geo coordinates of the place.';
    public const LABEL = 'geo';
    public const NAME = 'schema:geo';
    public const VALUES = ['GeoCoordinatesModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\GeoCoordinatesModel', 'GeoShapeModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\GeoShapeModel'];
    public const TYPES = ['Place' => 'Jolicode\Vocabularies\SchemaOrg\Type\PlaceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
