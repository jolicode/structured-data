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

final class RelatedTherapyModel
{
    public const DESCRIPTION = 'A medical therapy related to this anatomy.';
    public const LABEL = 'relatedTherapy';
    public const NAME = 'schema:relatedTherapy';
    public const VALUES = ['MedicalTherapyModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MedicalTherapyModel'];
    public const TYPES = ['AnatomicalStructure' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\AnatomicalStructureModel', 'AnatomicalSystem' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\AnatomicalSystemModel', 'SuperficialAnatomy' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\SuperficialAnatomyModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
