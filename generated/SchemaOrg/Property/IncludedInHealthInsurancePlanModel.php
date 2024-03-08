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

final class IncludedInHealthInsurancePlanModel
{
    public const DESCRIPTION = 'The insurance plans that cover this drug.';
    public const LABEL = 'includedInHealthInsurancePlan';
    public const NAME = 'schema:includedInHealthInsurancePlan';
    public const VALUES = ['HealthInsurancePlanModel' => 'SchemaOrg\Type\HealthInsurancePlanModel'];
    public const TYPES = ['Drug' => 'SchemaOrg\Type\DrugModel'];
}
