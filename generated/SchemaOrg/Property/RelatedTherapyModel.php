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

final class RelatedTherapyModel
{
    public const DESCRIPTION = 'A medical therapy related to this anatomy.';
    public const LABEL = 'relatedTherapy';
    public const NAME = 'schema:relatedTherapy';
    public const VALUES = ['MedicalTherapyModel' => 'SchemaOrg\Type\MedicalTherapyModel'];
    public const TYPES = ['AnatomicalStructure' => 'SchemaOrg\Type\AnatomicalStructureModel', 'AnatomicalSystem' => 'SchemaOrg\Type\AnatomicalSystemModel', 'SuperficialAnatomy' => 'SchemaOrg\Type\SuperficialAnatomyModel'];
}
