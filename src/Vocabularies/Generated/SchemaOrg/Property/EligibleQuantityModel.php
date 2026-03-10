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

final class EligibleQuantityModel
{
    public const DESCRIPTION = 'The interval and unit of measurement of ordering quantities for which the offer or price specification is valid. This allows e.g. specifying that a certain freight charge is valid only for a certain quantity.';
    public const LABEL = 'eligibleQuantity';
    public const NAME = 'schema:eligibleQuantity';
    public const VALUES = ['QuantitativeValueModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['Demand' => 'Jolicode\Vocabularies\SchemaOrg\Type\DemandModel', 'Offer' => 'Jolicode\Vocabularies\SchemaOrg\Type\OfferModel', 'PriceSpecification' => 'Jolicode\Vocabularies\SchemaOrg\Type\PriceSpecificationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
