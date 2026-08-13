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

final class AssociatedAnatomyModel
{
    public const DESCRIPTION = 'The anatomy of the underlying organ system or structures associated with this entity.';
    public const LABEL = 'associatedAnatomy';
    public const NAME = 'schema:associatedAnatomy';
    public const VALUES = ['AnatomicalStructureModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\AnatomicalStructureModel', 'AnatomicalSystemModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\AnatomicalSystemModel', 'SuperficialAnatomyModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\SuperficialAnatomyModel'];
    public const TYPES = ['MedicalCondition' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MedicalConditionModel', 'PhysicalActivity' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PhysicalActivityModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
