<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class ProviderModel
{
    public const DESCRIPTION = 'The service provider, service operator, or service performer; the goods producer. Another party (a seller) may offer those services or goods on behalf of the provider. A provider may also serve as the seller.';
    public const LABEL = 'provider';
    public const NAME = 'schema:provider';
    public const VALUES = ['OrganizationModel' => 'Jolicode\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'Jolicode\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Action' => 'Jolicode\SchemaOrg\Type\ActionModel', 'CreativeWork' => 'Jolicode\SchemaOrg\Type\CreativeWorkModel', 'EducationalOccupationalProgram' => 'Jolicode\SchemaOrg\Type\EducationalOccupationalProgramModel', 'Invoice' => 'Jolicode\SchemaOrg\Type\InvoiceModel', 'ParcelDelivery' => 'Jolicode\SchemaOrg\Type\ParcelDeliveryModel', 'Reservation' => 'Jolicode\SchemaOrg\Type\ReservationModel', 'Service' => 'Jolicode\SchemaOrg\Type\ServiceModel', 'Trip' => 'Jolicode\SchemaOrg\Type\TripModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
