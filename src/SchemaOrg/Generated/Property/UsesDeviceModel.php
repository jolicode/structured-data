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

final class UsesDeviceModel
{
    public const DESCRIPTION = 'Device used to perform the test.';
    public const LABEL = 'usesDevice';
    public const NAME = 'schema:usesDevice';
    public const VALUES = ['MedicalDeviceModel' => 'Jolicode\SchemaOrg\Type\MedicalDeviceModel'];
    public const TYPES = ['MedicalTest' => 'Jolicode\SchemaOrg\Type\MedicalTestModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
