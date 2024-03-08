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

final class PreOpModel
{
    public const DESCRIPTION = 'A description of the workup, testing, and other preparations required before implanting this device.';
    public const LABEL = 'preOp';
    public const NAME = 'schema:preOp';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['MedicalDevice' => 'SchemaOrg\Type\MedicalDeviceModel'];
}
