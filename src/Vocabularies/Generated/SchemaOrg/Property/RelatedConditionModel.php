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

final class RelatedConditionModel
{
    public const DESCRIPTION = 'A medical condition associated with this anatomy.';
    public const LABEL = 'relatedCondition';
    public const NAME = 'schema:relatedCondition';
    public const VALUES = ['MedicalConditionModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MedicalConditionModel'];
    public const TYPES = ['AnatomicalStructure' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\AnatomicalStructureModel', 'AnatomicalSystem' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\AnatomicalSystemModel', 'SuperficialAnatomy' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\SuperficialAnatomyModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
