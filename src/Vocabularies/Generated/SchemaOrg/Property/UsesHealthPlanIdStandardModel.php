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

final class UsesHealthPlanIdStandardModel
{
    public const DESCRIPTION = 'The standard for interpreting the Plan ID. The preferred is "HIOS". See the Centers for Medicare & Medicaid Services for more details.';
    public const LABEL = 'usesHealthPlanIdStandard';
    public const NAME = 'schema:usesHealthPlanIdStandard';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel', 'URLModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\URLModel'];
    public const TYPES = ['HealthInsurancePlan' => 'Jolicode\Vocabularies\SchemaOrg\Type\HealthInsurancePlanModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
