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

final class CostPerUnitModel
{
    public const DESCRIPTION = 'The cost per unit of the drug.';
    public const LABEL = 'costPerUnit';
    public const NAME = 'schema:costPerUnit';
    public const VALUES = ['NumberModel' => 'Jolicode\SchemaOrg\Type\NumberModel', 'QualitativeValueModel' => 'Jolicode\SchemaOrg\Type\QualitativeValueModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['DrugCost' => 'Jolicode\SchemaOrg\Type\DrugCostModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
