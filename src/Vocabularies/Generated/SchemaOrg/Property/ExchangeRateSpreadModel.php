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

final class ExchangeRateSpreadModel
{
    public const DESCRIPTION = 'The difference between the price at which a broker or other intermediary buys and sells foreign currency.';
    public const LABEL = 'exchangeRateSpread';
    public const NAME = 'schema:exchangeRateSpread';
    public const VALUES = ['MonetaryAmountModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MonetaryAmountModel', 'NumberModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\NumberModel'];
    public const TYPES = ['ExchangeRateSpecification' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ExchangeRateSpecificationModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1253'];
    public const SUPERSEDED_BY = null;
}
