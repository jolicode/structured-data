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

final class QualifiedExpenseModel
{
    public const DESCRIPTION = 'Optional. The types of expenses that are covered by the incentive. For example some incentives are only for the goods (tangible items) but the services (labor) are excluded.';
    public const LABEL = 'qualifiedExpense';
    public const NAME = 'schema:qualifiedExpense';
    public const VALUES = ['IncentiveQualifiedExpenseTypeModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\IncentiveQualifiedExpenseTypeModel'];
    public const TYPES = ['FinancialIncentive' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\FinancialIncentiveModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/3572'];
    public const SUPERSEDED_BY = null;
}
