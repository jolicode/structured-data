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

final class VehicleSpecialUsageModel
{
    public const DESCRIPTION = 'Indicates whether the vehicle has been used for special purposes, like commercial rental, driving school, or as a taxi. The legislation in many countries requires this information to be revealed when offering a car for sale.';
    public const LABEL = 'vehicleSpecialUsage';
    public const NAME = 'schema:vehicleSpecialUsage';
    public const VALUES = ['CarUsageTypeModel' => 'SchemaOrg\\Type\\CarUsageTypeModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['Vehicle' => 'SchemaOrg\\Type\\VehicleModel'];
}
