<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class IncludesObjectModel
{
    public const DESCRIPTION = 'This links to a node or nodes indicating the exact quantity of the products included in  an [[Offer]] or [[ProductCollection]].';
    public const LABEL = 'includesObject';
    public const NAME = 'schema:includesObject';
    public const VALUES = ['TypeAndQuantityNodeModel' => 'SchemaOrg\\Type\\TypeAndQuantityNodeModel'];
    public const TYPES = ['Demand' => 'SchemaOrg\\Type\\DemandModel', 'Offer' => 'SchemaOrg\\Type\\OfferModel', 'ProductCollection' => 'SchemaOrg\\Type\\ProductCollectionModel'];
}
