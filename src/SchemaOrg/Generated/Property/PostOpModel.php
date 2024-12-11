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

final class PostOpModel
{
    public const DESCRIPTION = 'A description of the postoperative procedures, care, and/or followups for this device.';
    public const LABEL = 'postOp';
    public const NAME = 'schema:postOp';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['MedicalDevice' => 'Jolicode\SchemaOrg\Type\MedicalDeviceModel'];
}
