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

final class ProviderModel
{
    public const DESCRIPTION = 'The service provider, service operator, or service performer; the goods producer. Another party (a seller) may offer those services or goods on behalf of the provider. A provider may also serve as the seller.';
    public const LABEL = 'provider';
    public const NAME = 'schema:provider';
    public const VALUES = ['OrganizationModel' => 'SchemaOrg\\Type\\OrganizationModel', 'PersonModel' => 'SchemaOrg\\Type\\PersonModel'];
    public const TYPES = ['Action' => 'SchemaOrg\\Type\\ActionModel', 'CreativeWork' => 'SchemaOrg\\Type\\CreativeWorkModel', 'EducationalOccupationalProgram' => 'SchemaOrg\\Type\\EducationalOccupationalProgramModel', 'Invoice' => 'SchemaOrg\\Type\\InvoiceModel', 'ParcelDelivery' => 'SchemaOrg\\Type\\ParcelDeliveryModel', 'Reservation' => 'SchemaOrg\\Type\\ReservationModel', 'Service' => 'SchemaOrg\\Type\\ServiceModel', 'Trip' => 'SchemaOrg\\Type\\TripModel'];
}
