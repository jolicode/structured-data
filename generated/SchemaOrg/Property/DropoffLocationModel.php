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

final class DropoffLocationModel
{
    public const DESCRIPTION = 'Where a rental car can be dropped off.';
    public const LABEL = 'dropoffLocation';
    public const NAME = 'schema:dropoffLocation';
    public const VALUES = ['PlaceModel' => 'SchemaOrg\Type\PlaceModel'];
    public const TYPES = ['RentalCarReservation' => 'SchemaOrg\Type\RentalCarReservationModel'];
}
