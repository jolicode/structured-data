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

final class ValidFromModel
{
    public const DESCRIPTION = 'The date when the item becomes valid.';
    public const LABEL = 'validFrom';
    public const NAME = 'schema:validFrom';
    public const VALUES = ['DateModel' => 'Jolicode\SchemaOrg\Type\DateModel', 'DateTimeModel' => 'Jolicode\SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['Demand' => 'Jolicode\SchemaOrg\Type\DemandModel', 'LocationFeatureSpecification' => 'Jolicode\SchemaOrg\Type\LocationFeatureSpecificationModel', 'MonetaryAmount' => 'Jolicode\SchemaOrg\Type\MonetaryAmountModel', 'Offer' => 'Jolicode\SchemaOrg\Type\OfferModel', 'OpeningHoursSpecification' => 'Jolicode\SchemaOrg\Type\OpeningHoursSpecificationModel', 'Permit' => 'Jolicode\SchemaOrg\Type\PermitModel', 'PriceSpecification' => 'Jolicode\SchemaOrg\Type\PriceSpecificationModel'];
}
