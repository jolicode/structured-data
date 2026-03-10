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

final class AssociatedPathophysiologyModel
{
    public const DESCRIPTION = 'If applicable, a description of the pathophysiology associated with the anatomical system, including potential abnormal changes in the mechanical, physical, and biochemical functions of the system.';
    public const LABEL = 'associatedPathophysiology';
    public const NAME = 'schema:associatedPathophysiology';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['AnatomicalStructure' => 'Jolicode\Vocabularies\SchemaOrg\Type\AnatomicalStructureModel', 'AnatomicalSystem' => 'Jolicode\Vocabularies\SchemaOrg\Type\AnatomicalSystemModel', 'SuperficialAnatomy' => 'Jolicode\Vocabularies\SchemaOrg\Type\SuperficialAnatomyModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
