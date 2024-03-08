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

final class HealthPlanMarketingUrlModel
{
    public const DESCRIPTION = 'The URL that goes directly to the plan brochure for the specific standard plan or plan variation.';
    public const LABEL = 'healthPlanMarketingUrl';
    public const NAME = 'schema:healthPlanMarketingUrl';
    public const VALUES = ['URLModel' => 'SchemaOrg\Type\URLModel'];
    public const TYPES = ['HealthInsurancePlan' => 'SchemaOrg\Type\HealthInsurancePlanModel'];
}
