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

final class WeightPercentageModel
{
    public const DESCRIPTION = 'Value representing the fraction of the weight that is used to compute the shipping price. Example: 0.10 and a shipping weight of 15kg would add $1.5 to the order price, where the $ is the currency of the order.';
    public const LABEL = 'weightPercentage';
    public const NAME = 'schema:weightPercentage';
    public const VALUES = ['NumberModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\NumberModel'];
    public const TYPES = ['ShippingRateSettings' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ShippingRateSettingsModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/3617'];
    public const SUPERSEDED_BY = null;
}
