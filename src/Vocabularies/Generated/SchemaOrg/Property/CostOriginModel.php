<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class CostOriginModel
{
    public const DESCRIPTION = 'Additional details to capture the origin of the cost data. For example, \'Medicare Part B\'.';
    public const LABEL = 'costOrigin';
    public const NAME = 'schema:costOrigin';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['DrugCost' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DrugCostModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
