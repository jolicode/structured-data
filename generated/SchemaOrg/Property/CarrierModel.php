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

final class CarrierModel
{
    public const DESCRIPTION = '\'carrier\' is an out-dated term indicating the \'provider\' for parcel delivery and flights.';
    public const LABEL = 'carrier';
    public const NAME = 'schema:carrier';
    public const VALUES = ['OrganizationModel' => 'SchemaOrg\\Type\\OrganizationModel'];
    public const TYPES = ['Flight' => 'SchemaOrg\\Type\\FlightModel', 'ParcelDelivery' => 'SchemaOrg\\Type\\ParcelDeliveryModel'];
}
