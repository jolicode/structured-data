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

final class EligibleWithSupplierModel
{
    public const DESCRIPTION = 'The supplier of the incentivized item/service for which the incentive is valid for such as a utility company, merchant, or contractor.';
    public const LABEL = 'eligibleWithSupplier';
    public const NAME = 'schema:eligibleWithSupplier';
    public const VALUES = ['OrganizationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\OrganizationModel'];
    public const TYPES = ['FinancialIncentive' => 'Jolicode\Vocabularies\SchemaOrg\Type\FinancialIncentiveModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
