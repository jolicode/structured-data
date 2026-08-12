<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class LocationModel
{
    public const DESCRIPTION = 'The location of, for example, where an event is happening, where an organization is located, or where an action takes place.';
    public const LABEL = 'location';
    public const NAME = 'schema:location';
    public const VALUES = ['PlaceModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PlaceModel', 'PostalAddressModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PostalAddressModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel', 'VirtualLocationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\VirtualLocationModel'];
    public const TYPES = ['Action' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ActionModel', 'Event' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\EventModel', 'InteractionCounter' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\InteractionCounterModel', 'Organization' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
