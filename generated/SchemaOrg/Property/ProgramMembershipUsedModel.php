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

final class ProgramMembershipUsedModel
{
    public const DESCRIPTION = 'Any membership in a frequent flyer, hotel loyalty program, etc. being applied to the reservation.';
    public const LABEL = 'programMembershipUsed';
    public const NAME = 'schema:programMembershipUsed';
    public const VALUES = ['ProgramMembershipModel' => 'SchemaOrg\\Type\\ProgramMembershipModel'];
    public const TYPES = ['Reservation' => 'SchemaOrg\\Type\\ReservationModel'];
}
