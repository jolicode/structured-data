<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class PurchaseDateModel
{
    public const DESCRIPTION = 'The date the item, e.g. vehicle, was purchased by the current owner.';
    public const LABEL = 'purchaseDate';
    public const NAME = 'schema:purchaseDate';
    public const VALUES = ['DateModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DateModel'];
    public const TYPES = ['Product' => 'Jolicode\Vocabularies\SchemaOrg\Type\ProductModel', 'Vehicle' => 'Jolicode\Vocabularies\SchemaOrg\Type\VehicleModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
