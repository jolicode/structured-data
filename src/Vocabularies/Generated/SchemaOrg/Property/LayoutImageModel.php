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

final class LayoutImageModel
{
    public const DESCRIPTION = 'A schematic image showing the floorplan layout.';
    public const LABEL = 'layoutImage';
    public const NAME = 'schema:layoutImage';
    public const VALUES = ['ImageObjectModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\ImageObjectModel', 'URLModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\URLModel'];
    public const TYPES = ['FloorPlan' => 'Jolicode\Vocabularies\SchemaOrg\Type\FloorPlanModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
