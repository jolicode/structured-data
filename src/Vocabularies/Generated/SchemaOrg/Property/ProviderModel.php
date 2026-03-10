<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class ProviderModel
{
    public const DESCRIPTION = 'The service provider, service operator, or service performer; the goods producer. Another party (a seller) may offer those services or goods on behalf of the provider. A provider may also serve as the seller.';
    public const LABEL = 'provider';
    public const NAME = 'schema:provider';
    public const VALUES = ['OrganizationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Action' => 'Jolicode\Vocabularies\SchemaOrg\Type\ActionModel', 'CreativeWork' => 'Jolicode\Vocabularies\SchemaOrg\Type\CreativeWorkModel', 'EducationalOccupationalProgram' => 'Jolicode\Vocabularies\SchemaOrg\Type\EducationalOccupationalProgramModel', 'FinancialIncentive' => 'Jolicode\Vocabularies\SchemaOrg\Type\FinancialIncentiveModel', 'Invoice' => 'Jolicode\Vocabularies\SchemaOrg\Type\InvoiceModel', 'ParcelDelivery' => 'Jolicode\Vocabularies\SchemaOrg\Type\ParcelDeliveryModel', 'Reservation' => 'Jolicode\Vocabularies\SchemaOrg\Type\ReservationModel', 'Service' => 'Jolicode\Vocabularies\SchemaOrg\Type\ServiceModel', 'Trip' => 'Jolicode\Vocabularies\SchemaOrg\Type\TripModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
