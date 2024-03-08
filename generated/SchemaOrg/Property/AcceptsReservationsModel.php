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

final class AcceptsReservationsModel
{
    public const DESCRIPTION = 'Indicates whether a FoodEstablishment accepts reservations. Values can be Boolean, an URL at which reservations can be made or (for backwards compatibility) the strings ```Yes``` or ```No```.';
    public const LABEL = 'acceptsReservations';
    public const NAME = 'schema:acceptsReservations';
    public const VALUES = ['BooleanModel' => 'SchemaOrg\\Type\\BooleanModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel', 'URLModel' => 'SchemaOrg\\Type\\URLModel'];
    public const TYPES = ['FoodEstablishment' => 'SchemaOrg\\Type\\FoodEstablishmentModel'];
}
