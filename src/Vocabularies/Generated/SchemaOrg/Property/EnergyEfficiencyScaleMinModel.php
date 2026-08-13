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

final class EnergyEfficiencyScaleMinModel
{
    public const DESCRIPTION = 'Specifies the least energy efficient class on the regulated EU energy consumption scale for the product category a product belongs to. For example, energy consumption for televisions placed on the market after January 1, 2020 is scaled from D to A+++.';
    public const LABEL = 'energyEfficiencyScaleMin';
    public const NAME = 'schema:energyEfficiencyScaleMin';
    public const VALUES = ['EUEnergyEfficiencyEnumerationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\EUEnergyEfficiencyEnumerationModel'];
    public const TYPES = ['EnergyConsumptionDetails' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\EnergyConsumptionDetailsModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2670'];
    public const SUPERSEDED_BY = null;
}
