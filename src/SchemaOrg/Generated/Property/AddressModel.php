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

final class AddressModel
{
    public const DESCRIPTION = 'Physical address of the item.';
    public const LABEL = 'address';
    public const NAME = 'schema:address';
    public const VALUES = ['PostalAddressModel' => 'Jolicode\SchemaOrg\Type\PostalAddressModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['GeoCoordinates' => 'Jolicode\SchemaOrg\Type\GeoCoordinatesModel', 'GeoShape' => 'Jolicode\SchemaOrg\Type\GeoShapeModel', 'Organization' => 'Jolicode\SchemaOrg\Type\OrganizationModel', 'Person' => 'Jolicode\SchemaOrg\Type\PersonModel', 'Place' => 'Jolicode\SchemaOrg\Type\PlaceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
