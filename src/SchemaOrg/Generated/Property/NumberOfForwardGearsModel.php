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

final class NumberOfForwardGearsModel
{
    public const DESCRIPTION = 'The total number of forward gears available for the transmission system of the vehicle.\n\nTypical unit code(s): C62.';
    public const LABEL = 'numberOfForwardGears';
    public const NAME = 'schema:numberOfForwardGears';
    public const VALUES = ['NumberModel' => 'Jolicode\SchemaOrg\Type\NumberModel', 'QuantitativeValueModel' => 'Jolicode\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['Vehicle' => 'Jolicode\SchemaOrg\Type\VehicleModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
