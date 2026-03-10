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

final class KnownVehicleDamagesModel
{
    public const DESCRIPTION = 'A textual description of known damages, both repaired and unrepaired.';
    public const LABEL = 'knownVehicleDamages';
    public const NAME = 'schema:knownVehicleDamages';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Vehicle' => 'Jolicode\Vocabularies\SchemaOrg\Type\VehicleModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
