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

final class SubReservationModel
{
    public const DESCRIPTION = 'The individual reservations included in the package. Typically a repeated property.';
    public const LABEL = 'subReservation';
    public const NAME = 'schema:subReservation';
    public const VALUES = ['ReservationModel' => 'SchemaOrg\Type\ReservationModel'];
    public const TYPES = ['ReservationPackage' => 'SchemaOrg\Type\ReservationPackageModel'];
}
