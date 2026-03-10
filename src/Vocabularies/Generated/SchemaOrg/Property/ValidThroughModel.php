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

final class ValidThroughModel
{
    public const DESCRIPTION = 'The date after when the item is not valid. For example the end of an offer, salary period, or a period of opening hours.';
    public const LABEL = 'validThrough';
    public const NAME = 'schema:validThrough';
    public const VALUES = ['DateModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DateModel', 'DateTimeModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['Demand' => 'Jolicode\Vocabularies\SchemaOrg\Type\DemandModel', 'FinancialIncentive' => 'Jolicode\Vocabularies\SchemaOrg\Type\FinancialIncentiveModel', 'JobPosting' => 'Jolicode\Vocabularies\SchemaOrg\Type\JobPostingModel', 'LocationFeatureSpecification' => 'Jolicode\Vocabularies\SchemaOrg\Type\LocationFeatureSpecificationModel', 'MonetaryAmount' => 'Jolicode\Vocabularies\SchemaOrg\Type\MonetaryAmountModel', 'Offer' => 'Jolicode\Vocabularies\SchemaOrg\Type\OfferModel', 'OpeningHoursSpecification' => 'Jolicode\Vocabularies\SchemaOrg\Type\OpeningHoursSpecificationModel', 'PriceSpecification' => 'Jolicode\Vocabularies\SchemaOrg\Type\PriceSpecificationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
