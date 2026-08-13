<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class TotalPriceModel
{
    public const DESCRIPTION = 'The total price for the reservation or ticket, including applicable taxes, shipping, etc.\n\nUsage guidelines:\n\n* Use values from 0123456789 (Unicode \'DIGIT ZERO\' (U+0030) to \'DIGIT NINE\' (U+0039)) rather than superficially similar Unicode symbols.\n* Use \'.\' (Unicode \'FULL STOP\' (U+002E)) rather than \',\' to indicate a decimal point. Avoid using these symbols as a readability separator.';
    public const LABEL = 'totalPrice';
    public const NAME = 'schema:totalPrice';
    public const VALUES = ['NumberModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\NumberModel', 'PriceSpecificationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PriceSpecificationModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Reservation' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ReservationModel', 'Ticket' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TicketModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
