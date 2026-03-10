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

final class RelatedConditionModel
{
    public const DESCRIPTION = 'A medical condition associated with this anatomy.';
    public const LABEL = 'relatedCondition';
    public const NAME = 'schema:relatedCondition';
    public const VALUES = ['MedicalConditionModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MedicalConditionModel'];
    public const TYPES = ['AnatomicalStructure' => 'Jolicode\Vocabularies\SchemaOrg\Type\AnatomicalStructureModel', 'AnatomicalSystem' => 'Jolicode\Vocabularies\SchemaOrg\Type\AnatomicalSystemModel', 'SuperficialAnatomy' => 'Jolicode\Vocabularies\SchemaOrg\Type\SuperficialAnatomyModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
