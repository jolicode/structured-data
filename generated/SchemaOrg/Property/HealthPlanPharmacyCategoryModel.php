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

final class HealthPlanPharmacyCategoryModel
{
    public const DESCRIPTION = 'The category or type of pharmacy associated with this cost sharing.';
    public const LABEL = 'healthPlanPharmacyCategory';
    public const NAME = 'schema:healthPlanPharmacyCategory';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['HealthPlanCostSharingSpecification' => 'SchemaOrg\Type\HealthPlanCostSharingSpecificationModel'];
}
