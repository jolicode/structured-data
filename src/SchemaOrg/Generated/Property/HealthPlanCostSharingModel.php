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

final class HealthPlanCostSharingModel
{
    public const DESCRIPTION = 'The costs to the patient for services under this network or formulary.';
    public const LABEL = 'healthPlanCostSharing';
    public const NAME = 'schema:healthPlanCostSharing';
    public const VALUES = ['BooleanModel' => 'Jolicode\SchemaOrg\Type\BooleanModel', 'HealthPlanCostSharingSpecificationModel' => 'Jolicode\SchemaOrg\Type\HealthPlanCostSharingSpecificationModel'];
    public const TYPES = ['HealthPlanFormulary' => 'Jolicode\SchemaOrg\Type\HealthPlanFormularyModel', 'HealthPlanNetwork' => 'Jolicode\SchemaOrg\Type\HealthPlanNetworkModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
