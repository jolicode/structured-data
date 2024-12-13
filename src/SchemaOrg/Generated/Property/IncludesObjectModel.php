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

final class IncludesObjectModel
{
    public const DESCRIPTION = 'This links to a node or nodes indicating the exact quantity of the products included in  an [[Offer]] or [[ProductCollection]].';
    public const LABEL = 'includesObject';
    public const NAME = 'schema:includesObject';
    public const VALUES = ['TypeAndQuantityNodeModel' => 'Jolicode\SchemaOrg\Type\TypeAndQuantityNodeModel'];
    public const TYPES = ['Demand' => 'Jolicode\SchemaOrg\Type\DemandModel', 'Offer' => 'Jolicode\SchemaOrg\Type\OfferModel', 'ProductCollection' => 'Jolicode\SchemaOrg\Type\ProductCollectionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
