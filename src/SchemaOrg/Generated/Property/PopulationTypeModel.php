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

final class PopulationTypeModel
{
    public const DESCRIPTION = 'Indicates the populationType common to all members of a [[StatisticalPopulation]] or all cases within the scope of a [[StatisticalVariable]].';
    public const LABEL = 'populationType';
    public const NAME = 'schema:populationType';
    public const VALUES = ['ClassModel' => 'Jolicode\SchemaOrg\Type\ClassModel'];
    public const TYPES = ['StatisticalPopulation' => 'Jolicode\SchemaOrg\Type\StatisticalPopulationModel', 'StatisticalVariable' => 'Jolicode\SchemaOrg\Type\StatisticalVariableModel'];
}
