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

final class BookingAgentModel
{
    public const DESCRIPTION = '\'bookingAgent\' is an out-dated term indicating a \'broker\' that serves as a booking agent.';
    public const LABEL = 'bookingAgent';
    public const NAME = 'schema:bookingAgent';
    public const VALUES = ['OrganizationModel' => 'SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Reservation' => 'SchemaOrg\Type\ReservationModel'];
}
