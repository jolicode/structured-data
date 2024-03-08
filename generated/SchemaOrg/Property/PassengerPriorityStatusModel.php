<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class PassengerPriorityStatusModel
{
    public const DESCRIPTION = 'The priority status assigned to a passenger for security or boarding (e.g. FastTrack or Priority).';
    public const LABEL = 'passengerPriorityStatus';
    public const NAME = 'schema:passengerPriorityStatus';
    public const VALUES = ['QualitativeValueModel' => 'SchemaOrg\\Type\\QualitativeValueModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['FlightReservation' => 'SchemaOrg\\Type\\FlightReservationModel'];
}
