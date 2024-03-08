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

final class CostCurrencyModel
{
    public const DESCRIPTION = 'The currency (in 3-letter) of the drug cost. See: http://en.wikipedia.org/wiki/ISO_4217. ';
    public const LABEL = 'costCurrency';
    public const NAME = 'schema:costCurrency';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['DrugCost' => 'SchemaOrg\Type\DrugCostModel'];
}
