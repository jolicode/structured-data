<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class UnderNameModel
{
    public const DESCRIPTION = 'The person or organization the reservation or ticket is for.';
    public const LABEL = 'underName';
    public const NAME = 'schema:underName';
    public const VALUES = ['OrganizationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Reservation' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ReservationModel', 'Ticket' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TicketModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
