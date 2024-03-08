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

final class VehicleIdentificationNumberModel
{
    public const DESCRIPTION = 'The Vehicle Identification Number (VIN) is a unique serial number used by the automotive industry to identify individual motor vehicles.';
    public const LABEL = 'vehicleIdentificationNumber';
    public const NAME = 'schema:vehicleIdentificationNumber';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['Vehicle' => 'SchemaOrg\\Type\\VehicleModel'];
}
