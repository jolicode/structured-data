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

final class DateVehicleFirstRegisteredModel
{
    public const DESCRIPTION = 'The date of the first registration of the vehicle with the respective public authorities.';
    public const LABEL = 'dateVehicleFirstRegistered';
    public const NAME = 'schema:dateVehicleFirstRegistered';
    public const VALUES = ['DateModel' => 'SchemaOrg\Type\DateModel'];
    public const TYPES = ['Vehicle' => 'SchemaOrg\Type\VehicleModel'];
}
