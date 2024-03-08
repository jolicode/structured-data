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

final class PopulationTypeModel
{
    public const DESCRIPTION = 'Indicates the populationType common to all members of a [[StatisticalPopulation]] or all cases within the scope of a [[StatisticalVariable]].';
    public const LABEL = 'populationType';
    public const NAME = 'schema:populationType';
    public const VALUES = ['ClassModel' => 'SchemaOrg\\Type\\ClassModel'];
    public const TYPES = ['StatisticalPopulation' => 'SchemaOrg\\Type\\StatisticalPopulationModel', 'StatisticalVariable' => 'SchemaOrg\\Type\\StatisticalVariableModel'];
}
