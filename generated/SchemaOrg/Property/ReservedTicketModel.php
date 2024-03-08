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

final class ReservedTicketModel
{
    public const DESCRIPTION = 'A ticket associated with the reservation.';
    public const LABEL = 'reservedTicket';
    public const NAME = 'schema:reservedTicket';
    public const VALUES = ['TicketModel' => 'SchemaOrg\Type\TicketModel'];
    public const TYPES = ['Reservation' => 'SchemaOrg\Type\ReservationModel'];
}
