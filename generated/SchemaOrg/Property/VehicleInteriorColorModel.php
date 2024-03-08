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

final class VehicleInteriorColorModel
{
    public const DESCRIPTION = 'The color or color combination of the interior of the vehicle.';
    public const LABEL = 'vehicleInteriorColor';
    public const NAME = 'schema:vehicleInteriorColor';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['Vehicle' => 'SchemaOrg\Type\VehicleModel'];
}
