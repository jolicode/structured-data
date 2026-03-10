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

final class LocationModel
{
    public const DESCRIPTION = 'The location of, for example, where an event is happening, where an organization is located, or where an action takes place.';
    public const LABEL = 'location';
    public const NAME = 'schema:location';
    public const VALUES = ['PlaceModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PlaceModel', 'PostalAddressModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PostalAddressModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel', 'VirtualLocationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\VirtualLocationModel'];
    public const TYPES = ['Action' => 'Jolicode\Vocabularies\SchemaOrg\Type\ActionModel', 'Event' => 'Jolicode\Vocabularies\SchemaOrg\Type\EventModel', 'InteractionCounter' => 'Jolicode\Vocabularies\SchemaOrg\Type\InteractionCounterModel', 'Organization' => 'Jolicode\Vocabularies\SchemaOrg\Type\OrganizationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
