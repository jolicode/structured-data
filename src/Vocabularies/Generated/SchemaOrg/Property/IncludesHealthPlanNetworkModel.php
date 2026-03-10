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

final class IncludesHealthPlanNetworkModel
{
    public const DESCRIPTION = 'Networks covered by this plan.';
    public const LABEL = 'includesHealthPlanNetwork';
    public const NAME = 'schema:includesHealthPlanNetwork';
    public const VALUES = ['HealthPlanNetworkModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\HealthPlanNetworkModel'];
    public const TYPES = ['HealthInsurancePlan' => 'Jolicode\Vocabularies\SchemaOrg\Type\HealthInsurancePlanModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
