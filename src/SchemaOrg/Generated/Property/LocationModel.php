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

final class LocationModel
{
    public const DESCRIPTION = 'The location of, for example, where an event is happening, where an organization is located, or where an action takes place.';
    public const LABEL = 'location';
    public const NAME = 'schema:location';
    public const VALUES = ['PlaceModel' => 'Jolicode\SchemaOrg\Type\PlaceModel', 'PostalAddressModel' => 'Jolicode\SchemaOrg\Type\PostalAddressModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel', 'VirtualLocationModel' => 'Jolicode\SchemaOrg\Type\VirtualLocationModel'];
    public const TYPES = ['Action' => 'Jolicode\SchemaOrg\Type\ActionModel', 'Event' => 'Jolicode\SchemaOrg\Type\EventModel', 'InteractionCounter' => 'Jolicode\SchemaOrg\Type\InteractionCounterModel', 'Organization' => 'Jolicode\SchemaOrg\Type\OrganizationModel'];
}
