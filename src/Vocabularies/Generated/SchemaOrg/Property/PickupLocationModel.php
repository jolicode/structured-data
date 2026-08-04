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

final class PickupLocationModel
{
    public const DESCRIPTION = 'Where a taxi will pick up a passenger or a rental car can be picked up.';
    public const LABEL = 'pickupLocation';
    public const NAME = 'schema:pickupLocation';
    public const VALUES = ['PlaceModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PlaceModel'];
    public const TYPES = ['RentalCarReservation' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\RentalCarReservationModel', 'TaxiReservation' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TaxiReservationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
