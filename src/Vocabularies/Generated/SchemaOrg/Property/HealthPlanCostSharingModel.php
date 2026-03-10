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

final class HealthPlanCostSharingModel
{
    public const DESCRIPTION = 'The costs to the patient for services under this network or formulary.';
    public const LABEL = 'healthPlanCostSharing';
    public const NAME = 'schema:healthPlanCostSharing';
    public const VALUES = ['BooleanModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\BooleanModel', 'HealthPlanCostSharingSpecificationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\HealthPlanCostSharingSpecificationModel'];
    public const TYPES = ['HealthPlanFormulary' => 'Jolicode\Vocabularies\SchemaOrg\Type\HealthPlanFormularyModel', 'HealthPlanNetwork' => 'Jolicode\Vocabularies\SchemaOrg\Type\HealthPlanNetworkModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
