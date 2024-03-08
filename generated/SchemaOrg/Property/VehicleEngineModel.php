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

final class VehicleEngineModel
{
    public const DESCRIPTION = 'Information about the engine or engines of the vehicle.';
    public const LABEL = 'vehicleEngine';
    public const NAME = 'schema:vehicleEngine';
    public const VALUES = ['EngineSpecificationModel' => 'SchemaOrg\\Type\\EngineSpecificationModel'];
    public const TYPES = ['Vehicle' => 'SchemaOrg\\Type\\VehicleModel'];
}
