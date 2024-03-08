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

final class HealthPlanCopayModel
{
    public const DESCRIPTION = 'The copay amount.';
    public const LABEL = 'healthPlanCopay';
    public const NAME = 'schema:healthPlanCopay';
    public const VALUES = ['PriceSpecificationModel' => 'SchemaOrg\Type\PriceSpecificationModel'];
    public const TYPES = ['HealthPlanCostSharingSpecification' => 'SchemaOrg\Type\HealthPlanCostSharingSpecificationModel'];
}
