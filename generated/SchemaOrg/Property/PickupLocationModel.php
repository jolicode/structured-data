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

final class PickupLocationModel
{
    public const DESCRIPTION = 'Where a taxi will pick up a passenger or a rental car can be picked up.';
    public const LABEL = 'pickupLocation';
    public const NAME = 'schema:pickupLocation';
    public const VALUES = ['PlaceModel' => 'SchemaOrg\Type\PlaceModel'];
    public const TYPES = ['RentalCarReservation' => 'SchemaOrg\Type\RentalCarReservationModel', 'TaxiReservation' => 'SchemaOrg\Type\TaxiReservationModel'];
}
