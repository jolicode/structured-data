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

final class ProductionDateModel
{
    public const DESCRIPTION = 'The date of production of the item, e.g. vehicle.';
    public const LABEL = 'productionDate';
    public const NAME = 'schema:productionDate';
    public const VALUES = ['DateModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DateModel'];
    public const TYPES = ['Product' => 'Jolicode\Vocabularies\SchemaOrg\Type\ProductModel', 'Vehicle' => 'Jolicode\Vocabularies\SchemaOrg\Type\VehicleModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
