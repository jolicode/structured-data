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

final class DriveWheelConfigurationModel
{
    public const DESCRIPTION = 'The drive wheel configuration, i.e. which roadwheels will receive torque from the vehicle\'s engine via the drivetrain.';
    public const LABEL = 'driveWheelConfiguration';
    public const NAME = 'schema:driveWheelConfiguration';
    public const VALUES = ['DriveWheelConfigurationValueModel' => 'SchemaOrg\Type\DriveWheelConfigurationValueModel', 'TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['Vehicle' => 'SchemaOrg\Type\VehicleModel'];
}
