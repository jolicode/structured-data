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

final class CostPerUnitModel
{
    public const DESCRIPTION = 'The cost per unit of the drug.';
    public const LABEL = 'costPerUnit';
    public const NAME = 'schema:costPerUnit';
    public const VALUES = ['NumberModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\NumberModel', 'QualitativeValueModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\QualitativeValueModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['DrugCost' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DrugCostModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
