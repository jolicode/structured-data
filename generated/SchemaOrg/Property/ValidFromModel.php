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

final class ValidFromModel
{
    public const DESCRIPTION = 'The date when the item becomes valid.';
    public const LABEL = 'validFrom';
    public const NAME = 'schema:validFrom';
    public const VALUES = ['DateModel' => 'SchemaOrg\\Type\\DateModel', 'DateTimeModel' => 'SchemaOrg\\Type\\DateTimeModel'];
    public const TYPES = ['Demand' => 'SchemaOrg\\Type\\DemandModel', 'LocationFeatureSpecification' => 'SchemaOrg\\Type\\LocationFeatureSpecificationModel', 'MonetaryAmount' => 'SchemaOrg\\Type\\MonetaryAmountModel', 'Offer' => 'SchemaOrg\\Type\\OfferModel', 'OpeningHoursSpecification' => 'SchemaOrg\\Type\\OpeningHoursSpecificationModel', 'Permit' => 'SchemaOrg\\Type\\PermitModel', 'PriceSpecification' => 'SchemaOrg\\Type\\PriceSpecificationModel'];
}
