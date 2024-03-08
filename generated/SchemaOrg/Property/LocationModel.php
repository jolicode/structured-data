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

final class LocationModel
{
    public const DESCRIPTION = 'The location of, for example, where an event is happening, where an organization is located, or where an action takes place.';
    public const LABEL = 'location';
    public const NAME = 'schema:location';
    public const VALUES = ['PlaceModel' => 'SchemaOrg\Type\PlaceModel', 'PostalAddressModel' => 'SchemaOrg\Type\PostalAddressModel', 'TextModel' => 'SchemaOrg\Type\TextModel', 'VirtualLocationModel' => 'SchemaOrg\Type\VirtualLocationModel'];
    public const TYPES = ['Action' => 'SchemaOrg\Type\ActionModel', 'Event' => 'SchemaOrg\Type\EventModel', 'InteractionCounter' => 'SchemaOrg\Type\InteractionCounterModel', 'Organization' => 'SchemaOrg\Type\OrganizationModel'];
}
