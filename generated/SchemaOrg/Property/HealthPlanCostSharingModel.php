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

final class HealthPlanCostSharingModel
{
    public const DESCRIPTION = 'The costs to the patient for services under this network or formulary.';
    public const LABEL = 'healthPlanCostSharing';
    public const NAME = 'schema:healthPlanCostSharing';
    public const VALUES = ['BooleanModel' => 'SchemaOrg\Type\BooleanModel'];
    public const TYPES = ['HealthPlanFormulary' => 'SchemaOrg\Type\HealthPlanFormularyModel', 'HealthPlanNetwork' => 'SchemaOrg\Type\HealthPlanNetworkModel'];
}
