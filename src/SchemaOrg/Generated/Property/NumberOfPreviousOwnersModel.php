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

final class NumberOfPreviousOwnersModel
{
    public const DESCRIPTION = 'The number of owners of the vehicle, including the current one.\n\nTypical unit code(s): C62.';
    public const LABEL = 'numberOfPreviousOwners';
    public const NAME = 'schema:numberOfPreviousOwners';
    public const VALUES = ['NumberModel' => 'Jolicode\SchemaOrg\Type\NumberModel', 'QuantitativeValueModel' => 'Jolicode\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['Vehicle' => 'Jolicode\SchemaOrg\Type\VehicleModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
