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

final class ValidThroughModel
{
    public const DESCRIPTION = 'The date after when the item is not valid. For example the end of an offer, salary period, or a period of opening hours.';
    public const LABEL = 'validThrough';
    public const NAME = 'schema:validThrough';
    public const VALUES = ['DateModel' => 'SchemaOrg\Type\DateModel', 'DateTimeModel' => 'SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['Demand' => 'SchemaOrg\Type\DemandModel', 'JobPosting' => 'SchemaOrg\Type\JobPostingModel', 'LocationFeatureSpecification' => 'SchemaOrg\Type\LocationFeatureSpecificationModel', 'MonetaryAmount' => 'SchemaOrg\Type\MonetaryAmountModel', 'Offer' => 'SchemaOrg\Type\OfferModel', 'OpeningHoursSpecification' => 'SchemaOrg\Type\OpeningHoursSpecificationModel', 'PriceSpecification' => 'SchemaOrg\Type\PriceSpecificationModel'];
}
