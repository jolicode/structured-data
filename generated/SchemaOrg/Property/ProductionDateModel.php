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

final class ProductionDateModel
{
    public const DESCRIPTION = 'The date of production of the item, e.g. vehicle.';
    public const LABEL = 'productionDate';
    public const NAME = 'schema:productionDate';
    public const VALUES = ['DateModel' => 'SchemaOrg\\Type\\DateModel'];
    public const TYPES = ['Product' => 'SchemaOrg\\Type\\ProductModel', 'Vehicle' => 'SchemaOrg\\Type\\VehicleModel'];
}
