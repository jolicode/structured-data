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

final class VehicleTransmissionModel
{
    public const DESCRIPTION = 'The type of component used for transmitting the power from a rotating power source to the wheels or other relevant component(s) ("gearbox" for cars).';
    public const LABEL = 'vehicleTransmission';
    public const NAME = 'schema:vehicleTransmission';
    public const VALUES = ['QualitativeValueModel' => 'SchemaOrg\Type\QualitativeValueModel', 'TextModel' => 'SchemaOrg\Type\TextModel', 'URLModel' => 'SchemaOrg\Type\URLModel'];
    public const TYPES = ['Vehicle' => 'SchemaOrg\Type\VehicleModel'];
}
