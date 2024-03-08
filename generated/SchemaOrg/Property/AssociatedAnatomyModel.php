<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class AssociatedAnatomyModel
{
    public const DESCRIPTION = 'The anatomy of the underlying organ system or structures associated with this entity.';
    public const LABEL = 'associatedAnatomy';
    public const NAME = 'schema:associatedAnatomy';
    public const VALUES = ['AnatomicalStructureModel' => 'SchemaOrg\Type\AnatomicalStructureModel', 'AnatomicalSystemModel' => 'SchemaOrg\Type\AnatomicalSystemModel', 'SuperficialAnatomyModel' => 'SchemaOrg\Type\SuperficialAnatomyModel'];
    public const TYPES = ['MedicalCondition' => 'SchemaOrg\Type\MedicalConditionModel', 'PhysicalActivity' => 'SchemaOrg\Type\PhysicalActivityModel'];
}
