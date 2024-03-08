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

final class EnergyEfficiencyScaleMaxModel
{
    public const DESCRIPTION = 'Specifies the most energy efficient class on the regulated EU energy consumption scale for the product category a product belongs to. For example, energy consumption for televisions placed on the market after January 1, 2020 is scaled from D to A+++.';
    public const LABEL = 'energyEfficiencyScaleMax';
    public const NAME = 'schema:energyEfficiencyScaleMax';
    public const VALUES = ['EUEnergyEfficiencyEnumerationModel' => 'SchemaOrg\\Type\\EUEnergyEfficiencyEnumerationModel'];
    public const TYPES = ['EnergyConsumptionDetails' => 'SchemaOrg\\Type\\EnergyConsumptionDetailsModel'];
}
