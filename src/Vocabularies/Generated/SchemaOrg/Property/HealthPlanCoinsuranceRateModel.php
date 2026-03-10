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

final class HealthPlanCoinsuranceRateModel
{
    public const DESCRIPTION = 'The rate of coinsurance expressed as a number between 0.0 and 1.0.';
    public const LABEL = 'healthPlanCoinsuranceRate';
    public const NAME = 'schema:healthPlanCoinsuranceRate';
    public const VALUES = ['NumberModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\NumberModel'];
    public const TYPES = ['HealthPlanCostSharingSpecification' => 'Jolicode\Vocabularies\SchemaOrg\Type\HealthPlanCostSharingSpecificationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
