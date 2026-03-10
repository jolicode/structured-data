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

final class HealthPlanNetworkIdModel
{
    public const DESCRIPTION = 'Name or unique ID of network. (Networks are often reused across different insurance plans.)';
    public const LABEL = 'healthPlanNetworkId';
    public const NAME = 'schema:healthPlanNetworkId';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['HealthPlanNetwork' => 'Jolicode\Vocabularies\SchemaOrg\Type\HealthPlanNetworkModel', 'MedicalOrganization' => 'Jolicode\Vocabularies\SchemaOrg\Type\MedicalOrganizationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
