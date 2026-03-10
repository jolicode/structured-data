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

final class VariableMeasuredModel
{
    public const DESCRIPTION = 'The variableMeasured property can indicate (repeated as necessary) the  variables that are measured in some dataset, either described as text or as pairs of identifier and description using PropertyValue, or more explicitly as a [[StatisticalVariable]].';
    public const LABEL = 'variableMeasured';
    public const NAME = 'schema:variableMeasured';
    public const VALUES = ['PropertyModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PropertyModel', 'PropertyValueModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PropertyValueModel', 'StatisticalVariableModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\StatisticalVariableModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Dataset' => 'Jolicode\Vocabularies\SchemaOrg\Type\DatasetModel', 'Observation' => 'Jolicode\Vocabularies\SchemaOrg\Type\ObservationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
