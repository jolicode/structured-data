<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class FeesAndCommissionsSpecificationModel
{
    public const DESCRIPTION = 'Description of fees, commissions, and other terms applied either to a class of financial product, or by a financial service organization.';
    public const LABEL = 'feesAndCommissionsSpecification';
    public const NAME = 'schema:feesAndCommissionsSpecification';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel', 'URLModel' => 'Jolicode\SchemaOrg\Type\URLModel'];
    public const TYPES = ['FinancialProduct' => 'Jolicode\SchemaOrg\Type\FinancialProductModel', 'FinancialService' => 'Jolicode\SchemaOrg\Type\FinancialServiceModel'];
}
