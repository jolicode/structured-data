<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class TicketedSeatModel
{
    public const DESCRIPTION = 'The seat associated with the ticket.';
    public const LABEL = 'ticketedSeat';
    public const NAME = 'schema:ticketedSeat';
    public const VALUES = ['SeatModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\SeatModel'];
    public const TYPES = ['Ticket' => 'Jolicode\Vocabularies\SchemaOrg\Type\TicketModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
