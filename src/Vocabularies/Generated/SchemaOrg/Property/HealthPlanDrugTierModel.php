<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class HealthPlanDrugTierModel
{
    public const DESCRIPTION = 'The tier(s) of drugs offered by this formulary or insurance plan.';
    public const LABEL = 'healthPlanDrugTier';
    public const NAME = 'schema:healthPlanDrugTier';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['HealthInsurancePlan' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\HealthInsurancePlanModel', 'HealthPlanFormulary' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\HealthPlanFormularyModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
