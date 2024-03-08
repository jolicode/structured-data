<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class PostalCodeModel
{
    public const DESCRIPTION = 'The postal code. For example, 94043.';
    public const LABEL = 'postalCode';
    public const NAME = 'schema:postalCode';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['DefinedRegion' => 'SchemaOrg\Type\DefinedRegionModel', 'GeoCoordinates' => 'SchemaOrg\Type\GeoCoordinatesModel', 'GeoShape' => 'SchemaOrg\Type\GeoShapeModel', 'PostalAddress' => 'SchemaOrg\Type\PostalAddressModel'];
}
