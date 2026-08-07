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

final class IncentiveTypeModel
{
    public const DESCRIPTION = 'The type of incentive offered (tax credit/rebate, tax deduction, tax waiver, subsidies, etc.).';
    public const LABEL = 'incentiveType';
    public const NAME = 'schema:incentiveType';
    public const VALUES = ['IncentiveTypeModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\IncentiveTypeModel'];
    public const TYPES = ['FinancialIncentive' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\FinancialIncentiveModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/3572'];
    public const SUPERSEDED_BY = null;
}
