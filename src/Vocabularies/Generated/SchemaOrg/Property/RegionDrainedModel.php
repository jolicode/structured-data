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

final class RegionDrainedModel
{
    public const DESCRIPTION = 'The anatomical or organ system drained by this vessel; generally refers to a specific part of an organ.';
    public const LABEL = 'regionDrained';
    public const NAME = 'schema:regionDrained';
    public const VALUES = ['AnatomicalStructureModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\AnatomicalStructureModel', 'AnatomicalSystemModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\AnatomicalSystemModel'];
    public const TYPES = ['LymphaticVessel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\LymphaticVesselModel', 'Vein' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\VeinModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
