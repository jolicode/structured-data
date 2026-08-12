<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class VariableMeasuredModel
{
    public const DESCRIPTION = 'The variableMeasured property can indicate (repeated as necessary) the  variables that are measured in some dataset, either described as text or as pairs of identifier and description using PropertyValue, or more explicitly as a [[StatisticalVariable]].';
    public const LABEL = 'variableMeasured';
    public const NAME = 'schema:variableMeasured';
    public const VALUES = ['PropertyModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PropertyModel', 'PropertyValueModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PropertyValueModel', 'StatisticalVariableModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\StatisticalVariableModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Dataset' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DatasetModel', 'Observation' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ObservationModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1083'];
    public const SUPERSEDED_BY = null;
}
