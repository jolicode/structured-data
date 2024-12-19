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

final class ApplicableLocationModel
{
    public const DESCRIPTION = 'The location in which the status applies.';
    public const LABEL = 'applicableLocation';
    public const NAME = 'schema:applicableLocation';
    public const VALUES = ['AdministrativeAreaModel' => 'Jolicode\SchemaOrg\Type\AdministrativeAreaModel'];
    public const TYPES = ['DrugCost' => 'Jolicode\SchemaOrg\Type\DrugCostModel', 'DrugLegalStatus' => 'Jolicode\SchemaOrg\Type\DrugLegalStatusModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
