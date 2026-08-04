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

final class CurrentExchangeRateModel
{
    public const DESCRIPTION = 'The current price of a currency.';
    public const LABEL = 'currentExchangeRate';
    public const NAME = 'schema:currentExchangeRate';
    public const VALUES = ['UnitPriceSpecificationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\UnitPriceSpecificationModel'];
    public const TYPES = ['ExchangeRateSpecification' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ExchangeRateSpecificationModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1253'];
    public const SUPERSEDED_BY = null;
}
