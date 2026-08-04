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

final class PickupTimeModel
{
    public const DESCRIPTION = 'When a taxi will pick up a passenger or a rental car can be picked up.';
    public const LABEL = 'pickupTime';
    public const NAME = 'schema:pickupTime';
    public const VALUES = ['DateTimeModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['RentalCarReservation' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\RentalCarReservationModel', 'TaxiReservation' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TaxiReservationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
