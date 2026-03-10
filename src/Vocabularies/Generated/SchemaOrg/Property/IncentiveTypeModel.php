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

final class IncentiveTypeModel
{
    public const DESCRIPTION = 'The type of incentive offered (tax credit/rebate, tax deduction, tax waiver, subsidies, etc.).';
    public const LABEL = 'incentiveType';
    public const NAME = 'schema:incentiveType';
    public const VALUES = ['IncentiveTypeModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\IncentiveTypeModel'];
    public const TYPES = ['FinancialIncentive' => 'Jolicode\Vocabularies\SchemaOrg\Type\FinancialIncentiveModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
