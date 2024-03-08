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

final class SteeringPositionModel
{
    public const DESCRIPTION = 'The position of the steering wheel or similar device (mostly for cars).';
    public const LABEL = 'steeringPosition';
    public const NAME = 'schema:steeringPosition';
    public const VALUES = ['SteeringPositionValueModel' => 'SchemaOrg\\Type\\SteeringPositionValueModel'];
    public const TYPES = ['Vehicle' => 'SchemaOrg\\Type\\VehicleModel'];
}
