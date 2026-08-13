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

final class OrderValueModel
{
    public const DESCRIPTION = 'Minimum and maximum order value for which these shipping conditions are valid.';
    public const LABEL = 'orderValue';
    public const NAME = 'schema:orderValue';
    public const VALUES = ['MonetaryAmountModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MonetaryAmountModel'];
    public const TYPES = ['ShippingConditions' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ShippingConditionsModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/3617'];
    public const SUPERSEDED_BY = null;
}
