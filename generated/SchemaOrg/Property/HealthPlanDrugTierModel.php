<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class HealthPlanDrugTierModel
{
    public const DESCRIPTION = 'The tier(s) of drugs offered by this formulary or insurance plan.';
    public const LABEL = 'healthPlanDrugTier';
    public const NAME = 'schema:healthPlanDrugTier';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['HealthInsurancePlan' => 'SchemaOrg\\Type\\HealthInsurancePlanModel', 'HealthPlanFormulary' => 'SchemaOrg\\Type\\HealthPlanFormularyModel'];
}
