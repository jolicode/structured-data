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

final class IncludesHealthPlanFormularyModel
{
    public const DESCRIPTION = 'Formularies covered by this plan.';
    public const LABEL = 'includesHealthPlanFormulary';
    public const NAME = 'schema:includesHealthPlanFormulary';
    public const VALUES = ['HealthPlanFormularyModel' => 'Jolicode\SchemaOrg\Type\HealthPlanFormularyModel'];
    public const TYPES = ['HealthInsurancePlan' => 'Jolicode\SchemaOrg\Type\HealthInsurancePlanModel'];
}
