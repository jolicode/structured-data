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

final class AssociatedAnatomyModel
{
    public const DESCRIPTION = 'The anatomy of the underlying organ system or structures associated with this entity.';
    public const LABEL = 'associatedAnatomy';
    public const NAME = 'schema:associatedAnatomy';
    public const VALUES = ['AnatomicalStructureModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\AnatomicalStructureModel', 'AnatomicalSystemModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\AnatomicalSystemModel', 'SuperficialAnatomyModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\SuperficialAnatomyModel'];
    public const TYPES = ['MedicalCondition' => 'Jolicode\Vocabularies\SchemaOrg\Type\MedicalConditionModel', 'PhysicalActivity' => 'Jolicode\Vocabularies\SchemaOrg\Type\PhysicalActivityModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
