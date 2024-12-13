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

final class ReservationStatusModel
{
    public const DESCRIPTION = 'The current status of the reservation.';
    public const LABEL = 'reservationStatus';
    public const NAME = 'schema:reservationStatus';
    public const VALUES = ['ReservationStatusTypeModel' => 'Jolicode\SchemaOrg\Type\ReservationStatusTypeModel'];
    public const TYPES = ['Reservation' => 'Jolicode\SchemaOrg\Type\ReservationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
