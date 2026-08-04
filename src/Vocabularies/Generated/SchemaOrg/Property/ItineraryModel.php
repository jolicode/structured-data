<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class ItineraryModel
{
    public const DESCRIPTION = 'Destination(s) ( [[Place]] ) that make up a trip. For a trip where destination order is important use [[ItemList]] to specify that order (see examples).';
    public const LABEL = 'itinerary';
    public const NAME = 'schema:itinerary';
    public const VALUES = ['ItemListModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ItemListModel', 'PlaceModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PlaceModel'];
    public const TYPES = ['Trip' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TripModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1810'];
    public const SUPERSEDED_BY = null;
}
