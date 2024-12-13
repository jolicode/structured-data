<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class NumberOfDoorsModel
{
    public const DESCRIPTION = 'The number of doors.\n\nTypical unit code(s): C62.';
    public const LABEL = 'numberOfDoors';
    public const NAME = 'schema:numberOfDoors';
    public const VALUES = ['NumberModel' => 'Jolicode\SchemaOrg\Type\NumberModel', 'QuantitativeValueModel' => 'Jolicode\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['Vehicle' => 'Jolicode\SchemaOrg\Type\VehicleModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
