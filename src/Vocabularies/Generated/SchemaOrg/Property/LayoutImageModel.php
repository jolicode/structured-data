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

final class LayoutImageModel
{
    public const DESCRIPTION = 'A schematic image showing the floorplan layout.';
    public const LABEL = 'layoutImage';
    public const NAME = 'schema:layoutImage';
    public const VALUES = ['ImageObjectModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ImageObjectModel', 'URLModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\URLModel'];
    public const TYPES = ['FloorPlan' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\FloorPlanModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2690'];
    public const SUPERSEDED_BY = null;
}
