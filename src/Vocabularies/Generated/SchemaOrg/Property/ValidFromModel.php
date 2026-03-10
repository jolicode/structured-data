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

final class ValidFromModel
{
    public const DESCRIPTION = 'The date when the item becomes valid.';
    public const LABEL = 'validFrom';
    public const NAME = 'schema:validFrom';
    public const VALUES = ['DateModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DateModel', 'DateTimeModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['Certification' => 'Jolicode\Vocabularies\SchemaOrg\Type\CertificationModel', 'Demand' => 'Jolicode\Vocabularies\SchemaOrg\Type\DemandModel', 'FinancialIncentive' => 'Jolicode\Vocabularies\SchemaOrg\Type\FinancialIncentiveModel', 'LocationFeatureSpecification' => 'Jolicode\Vocabularies\SchemaOrg\Type\LocationFeatureSpecificationModel', 'MonetaryAmount' => 'Jolicode\Vocabularies\SchemaOrg\Type\MonetaryAmountModel', 'Offer' => 'Jolicode\Vocabularies\SchemaOrg\Type\OfferModel', 'OpeningHoursSpecification' => 'Jolicode\Vocabularies\SchemaOrg\Type\OpeningHoursSpecificationModel', 'Permit' => 'Jolicode\Vocabularies\SchemaOrg\Type\PermitModel', 'PriceSpecification' => 'Jolicode\Vocabularies\SchemaOrg\Type\PriceSpecificationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
