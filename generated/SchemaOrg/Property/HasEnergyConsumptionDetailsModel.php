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

final class HasEnergyConsumptionDetailsModel
{
    public const DESCRIPTION = 'Defines the energy efficiency Category (also known as "class" or "rating") for a product according to an international energy efficiency standard.';
    public const LABEL = 'hasEnergyConsumptionDetails';
    public const NAME = 'schema:hasEnergyConsumptionDetails';
    public const VALUES = ['EnergyConsumptionDetailsModel' => 'SchemaOrg\Type\EnergyConsumptionDetailsModel'];
    public const TYPES = ['Product' => 'SchemaOrg\Type\ProductModel'];
}
