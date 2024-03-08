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

final class DateIssuedModel
{
    public const DESCRIPTION = 'The date the ticket was issued.';
    public const LABEL = 'dateIssued';
    public const NAME = 'schema:dateIssued';
    public const VALUES = ['DateModel' => 'SchemaOrg\\Type\\DateModel', 'DateTimeModel' => 'SchemaOrg\\Type\\DateTimeModel'];
    public const TYPES = ['Ticket' => 'SchemaOrg\\Type\\TicketModel'];
}
