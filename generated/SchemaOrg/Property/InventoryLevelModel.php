<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class InventoryLevelModel
{
    public const DESCRIPTION = 'The current approximate inventory level for the item or items.';
    public const LABEL = 'inventoryLevel';
    public const NAME = 'schema:inventoryLevel';
    public const VALUES = ['QuantitativeValueModel' => 'SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['Demand' => 'SchemaOrg\Type\DemandModel', 'Offer' => 'SchemaOrg\Type\OfferModel', 'SomeProducts' => 'SchemaOrg\Type\SomeProductsModel'];
}
