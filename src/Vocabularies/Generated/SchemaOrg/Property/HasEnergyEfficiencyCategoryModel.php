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

final class HasEnergyEfficiencyCategoryModel
{
    public const DESCRIPTION = 'Defines the energy efficiency Category (which could be either a rating out of range of values or a yes/no certification) for a product according to an international energy efficiency standard.';
    public const LABEL = 'hasEnergyEfficiencyCategory';
    public const NAME = 'schema:hasEnergyEfficiencyCategory';
    public const VALUES = ['EnergyEfficiencyEnumerationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\EnergyEfficiencyEnumerationModel'];
    public const TYPES = ['EnergyConsumptionDetails' => 'Jolicode\Vocabularies\SchemaOrg\Type\EnergyConsumptionDetailsModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
