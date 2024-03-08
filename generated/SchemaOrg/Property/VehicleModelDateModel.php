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

final class VehicleModelDateModel
{
    public const DESCRIPTION = 'The release date of a vehicle model (often used to differentiate versions of the same make and model).';
    public const LABEL = 'vehicleModelDate';
    public const NAME = 'schema:vehicleModelDate';
    public const VALUES = ['DateModel' => 'SchemaOrg\\Type\\DateModel'];
    public const TYPES = ['Vehicle' => 'SchemaOrg\\Type\\VehicleModel'];
}
