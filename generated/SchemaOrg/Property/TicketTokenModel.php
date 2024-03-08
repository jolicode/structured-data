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

final class TicketTokenModel
{
    public const DESCRIPTION = 'Reference to an asset (e.g., Barcode, QR code image or PDF) usable for entrance.';
    public const LABEL = 'ticketToken';
    public const NAME = 'schema:ticketToken';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel', 'URLModel' => 'SchemaOrg\\Type\\URLModel'];
    public const TYPES = ['Ticket' => 'SchemaOrg\\Type\\TicketModel'];
}
