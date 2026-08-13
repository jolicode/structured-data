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

final class OrderQuantityModel
{
    public const DESCRIPTION = 'The number of the item ordered. If the property is not set, assume the quantity is one.';
    public const LABEL = 'orderQuantity';
    public const NAME = 'schema:orderQuantity';
    public const VALUES = ['NumberModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\NumberModel', 'QuantitativeValueModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['OrderItem' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OrderItemModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
