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

final class PopulationTypeModel
{
    public const DESCRIPTION = 'Indicates the populationType common to all members of a [[StatisticalPopulation]] or all cases within the scope of a [[StatisticalVariable]].';
    public const LABEL = 'populationType';
    public const NAME = 'schema:populationType';
    public const VALUES = ['ClassModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ClassModel'];
    public const TYPES = ['StatisticalPopulation' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\StatisticalPopulationModel', 'StatisticalVariable' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\StatisticalVariableModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2291'];
    public const SUPERSEDED_BY = null;
}
