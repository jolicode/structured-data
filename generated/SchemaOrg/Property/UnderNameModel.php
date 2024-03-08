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

final class UnderNameModel
{
    public const DESCRIPTION = 'The person or organization the reservation or ticket is for.';
    public const LABEL = 'underName';
    public const NAME = 'schema:underName';
    public const VALUES = ['OrganizationModel' => 'SchemaOrg\\Type\\OrganizationModel', 'PersonModel' => 'SchemaOrg\\Type\\PersonModel'];
    public const TYPES = ['Reservation' => 'SchemaOrg\\Type\\ReservationModel', 'Ticket' => 'SchemaOrg\\Type\\TicketModel'];
}
