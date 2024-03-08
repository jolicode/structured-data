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

final class ItineraryModel
{
    public const DESCRIPTION = 'Destination(s) ( [[Place]] ) that make up a trip. For a trip where destination order is important use [[ItemList]] to specify that order (see examples).';
    public const LABEL = 'itinerary';
    public const NAME = 'schema:itinerary';
    public const VALUES = ['ItemListModel' => 'SchemaOrg\Type\ItemListModel', 'PlaceModel' => 'SchemaOrg\Type\PlaceModel'];
    public const TYPES = ['Trip' => 'SchemaOrg\Type\TripModel'];
}
