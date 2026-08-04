<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class BillingStartModel
{
    public const DESCRIPTION = 'Specifies after how much time this price (or price component) becomes valid and billing starts. Can be used, for example, to model a price increase after the first year of a subscription. The unit of measurement is specified by the unitCode property.';
    public const LABEL = 'billingStart';
    public const NAME = 'schema:billingStart';
    public const VALUES = ['NumberModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\NumberModel'];
    public const TYPES = ['UnitPriceSpecification' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\UnitPriceSpecificationModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2689'];
    public const SUPERSEDED_BY = null;
}
