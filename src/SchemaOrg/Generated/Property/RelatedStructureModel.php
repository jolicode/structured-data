<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class RelatedStructureModel
{
    public const DESCRIPTION = 'Related anatomical structure(s) that are not part of the system but relate or connect to it, such as vascular bundles associated with an organ system.';
    public const LABEL = 'relatedStructure';
    public const NAME = 'schema:relatedStructure';
    public const VALUES = ['AnatomicalStructureModel' => 'Jolicode\SchemaOrg\Type\AnatomicalStructureModel'];
    public const TYPES = ['AnatomicalSystem' => 'Jolicode\SchemaOrg\Type\AnatomicalSystemModel'];
}
