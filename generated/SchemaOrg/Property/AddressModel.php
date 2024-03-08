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

final class AddressModel
{
    public const DESCRIPTION = 'Physical address of the item.';
    public const LABEL = 'address';
    public const NAME = 'schema:address';
    public const VALUES = ['PostalAddressModel' => 'SchemaOrg\Type\PostalAddressModel', 'TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['GeoCoordinates' => 'SchemaOrg\Type\GeoCoordinatesModel', 'GeoShape' => 'SchemaOrg\Type\GeoShapeModel', 'Organization' => 'SchemaOrg\Type\OrganizationModel', 'Person' => 'SchemaOrg\Type\PersonModel', 'Place' => 'SchemaOrg\Type\PlaceModel'];
}
