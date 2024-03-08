<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class ProcedureModel
{
    public const DESCRIPTION = 'A description of the procedure involved in setting up, using, and/or installing the device.';
    public const LABEL = 'procedure';
    public const NAME = 'schema:procedure';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['MedicalDevice' => 'SchemaOrg\\Type\\MedicalDeviceModel'];
}
