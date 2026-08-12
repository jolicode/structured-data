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

final class CostCategoryModel
{
    public const DESCRIPTION = 'The category of cost, such as wholesale, retail, reimbursement cap, etc.';
    public const LABEL = 'costCategory';
    public const NAME = 'schema:costCategory';
    public const VALUES = ['DrugCostCategoryModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DrugCostCategoryModel'];
    public const TYPES = ['DrugCost' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DrugCostModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
