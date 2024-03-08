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

final class RegionDrainedModel
{
    public const DESCRIPTION = 'The anatomical or organ system drained by this vessel; generally refers to a specific part of an organ.';
    public const LABEL = 'regionDrained';
    public const NAME = 'schema:regionDrained';
    public const VALUES = ['AnatomicalStructureModel' => 'SchemaOrg\Type\AnatomicalStructureModel', 'AnatomicalSystemModel' => 'SchemaOrg\Type\AnatomicalSystemModel'];
    public const TYPES = ['LymphaticVessel' => 'SchemaOrg\Type\LymphaticVesselModel', 'Vein' => 'SchemaOrg\Type\VeinModel'];
}
