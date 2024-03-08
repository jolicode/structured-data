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

final class SeatingCapacityModel
{
    public const DESCRIPTION = 'The number of persons that can be seated (e.g. in a vehicle), both in terms of the physical space available, and in terms of limitations set by law.\n\nTypical unit code(s): C62 for persons ';
    public const LABEL = 'seatingCapacity';
    public const NAME = 'schema:seatingCapacity';
    public const VALUES = ['NumberModel' => 'SchemaOrg\Type\NumberModel', 'QuantitativeValueModel' => 'SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['Vehicle' => 'SchemaOrg\Type\VehicleModel'];
}
