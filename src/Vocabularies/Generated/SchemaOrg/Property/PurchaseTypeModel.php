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

final class PurchaseTypeModel
{
    public const DESCRIPTION = 'Optional. The type of purchase the consumer must make in order to qualify for this incentive.';
    public const LABEL = 'purchaseType';
    public const NAME = 'schema:purchaseType';
    public const VALUES = ['PurchaseTypeModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PurchaseTypeModel'];
    public const TYPES = ['FinancialIncentive' => 'Jolicode\Vocabularies\SchemaOrg\Type\FinancialIncentiveModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
