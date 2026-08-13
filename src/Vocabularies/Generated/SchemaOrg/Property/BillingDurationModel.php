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

final class BillingDurationModel
{
    public const DESCRIPTION = 'Specifies for how long this price (or price component) will be billed. Can be used, for example, to model the contractual duration of a subscription or payment plan. Type can be either a Duration or a Number (in which case the unit of measurement, for example month, is specified by the unitCode property).';
    public const LABEL = 'billingDuration';
    public const NAME = 'schema:billingDuration';
    public const VALUES = ['DurationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DurationModel', 'NumberModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\NumberModel', 'QuantitativeValueModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['UnitPriceSpecification' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\UnitPriceSpecificationModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2689'];
    public const SUPERSEDED_BY = null;
}
