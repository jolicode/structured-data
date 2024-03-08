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

final class TicketNumberModel
{
    public const DESCRIPTION = 'The unique identifier for the ticket.';
    public const LABEL = 'ticketNumber';
    public const NAME = 'schema:ticketNumber';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['Ticket' => 'SchemaOrg\\Type\\TicketModel'];
}
