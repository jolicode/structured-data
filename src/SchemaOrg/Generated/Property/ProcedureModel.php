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

final class ProcedureModel
{
    public const DESCRIPTION = 'A description of the procedure involved in setting up, using, and/or installing the device.';
    public const LABEL = 'procedure';
    public const NAME = 'schema:procedure';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['MedicalDevice' => 'Jolicode\SchemaOrg\Type\MedicalDeviceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
