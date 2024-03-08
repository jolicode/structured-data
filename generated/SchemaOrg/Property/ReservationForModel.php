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

final class ReservationForModel
{
    public const DESCRIPTION = 'The thing -- flight, event, restaurant, etc. being reserved.';
    public const LABEL = 'reservationFor';
    public const NAME = 'schema:reservationFor';
    public const VALUES = ['ThingModel' => 'SchemaOrg\\Type\\ThingModel'];
    public const TYPES = ['Reservation' => 'SchemaOrg\\Type\\ReservationModel'];
}
