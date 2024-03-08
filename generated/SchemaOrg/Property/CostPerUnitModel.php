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

final class CostPerUnitModel
{
    public const DESCRIPTION = 'The cost per unit of the drug.';
    public const LABEL = 'costPerUnit';
    public const NAME = 'schema:costPerUnit';
    public const VALUES = ['NumberModel' => 'SchemaOrg\\Type\\NumberModel', 'QualitativeValueModel' => 'SchemaOrg\\Type\\QualitativeValueModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['DrugCost' => 'SchemaOrg\\Type\\DrugCostModel'];
}
