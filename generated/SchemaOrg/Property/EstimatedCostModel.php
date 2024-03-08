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

final class EstimatedCostModel
{
    public const DESCRIPTION = 'The estimated cost of the supply or supplies consumed when performing instructions.';
    public const LABEL = 'estimatedCost';
    public const NAME = 'schema:estimatedCost';
    public const VALUES = ['MonetaryAmountModel' => 'SchemaOrg\\Type\\MonetaryAmountModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['HowTo' => 'SchemaOrg\\Type\\HowToModel', 'HowToSupply' => 'SchemaOrg\\Type\\HowToSupplyModel'];
}
