<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class ProviderModel
{
    public const DESCRIPTION = 'The service provider, service operator, or service performer; the goods producer. Another party (a seller) may offer those services or goods on behalf of the provider. A provider may also serve as the seller.';
    public const LABEL = 'provider';
    public const NAME = 'schema:provider';
    public const VALUES = ['OrganizationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Action' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ActionModel', 'CreativeWork' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkModel', 'EducationalOccupationalProgram' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\EducationalOccupationalProgramModel', 'FinancialIncentive' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\FinancialIncentiveModel', 'Invoice' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\InvoiceModel', 'ParcelDelivery' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ParcelDeliveryModel', 'Reservation' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ReservationModel', 'Service' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ServiceModel', 'Trip' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TripModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2289', 'https://github.com/schemaorg/schemaorg/issues/2927'];
    public const SUPERSEDED_BY = null;
}
