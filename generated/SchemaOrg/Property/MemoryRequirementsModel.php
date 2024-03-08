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

final class MemoryRequirementsModel
{
    public const DESCRIPTION = 'Minimum memory requirements.';
    public const LABEL = 'memoryRequirements';
    public const NAME = 'schema:memoryRequirements';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel', 'URLModel' => 'SchemaOrg\Type\URLModel'];
    public const TYPES = ['SoftwareApplication' => 'SchemaOrg\Type\SoftwareApplicationModel'];
}
