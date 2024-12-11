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

final class PassengerSequenceNumberModel
{
    public const DESCRIPTION = 'The passenger\'s sequence number as assigned by the airline.';
    public const LABEL = 'passengerSequenceNumber';
    public const NAME = 'schema:passengerSequenceNumber';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['FlightReservation' => 'Jolicode\SchemaOrg\Type\FlightReservationModel'];
}
