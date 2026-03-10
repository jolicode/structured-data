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

final class ValidThroughModel
{
    public const DESCRIPTION = 'The date after when the item is not valid. For example the end of an offer, salary period, or a period of opening hours.';
    public const LABEL = 'validThrough';
    public const NAME = 'schema:validThrough';
    public const VALUES = ['DateModel' => 'Jolicode\SchemaOrg\Type\DateModel', 'DateTimeModel' => 'Jolicode\SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['Demand' => 'Jolicode\SchemaOrg\Type\DemandModel', 'FinancialIncentive' => 'Jolicode\SchemaOrg\Type\FinancialIncentiveModel', 'JobPosting' => 'Jolicode\SchemaOrg\Type\JobPostingModel', 'LocationFeatureSpecification' => 'Jolicode\SchemaOrg\Type\LocationFeatureSpecificationModel', 'MonetaryAmount' => 'Jolicode\SchemaOrg\Type\MonetaryAmountModel', 'Offer' => 'Jolicode\SchemaOrg\Type\OfferModel', 'OpeningHoursSpecification' => 'Jolicode\SchemaOrg\Type\OpeningHoursSpecificationModel', 'PriceSpecification' => 'Jolicode\SchemaOrg\Type\PriceSpecificationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
