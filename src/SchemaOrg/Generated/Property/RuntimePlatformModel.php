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

final class RuntimePlatformModel
{
    public const DESCRIPTION = 'Runtime platform or script interpreter dependencies (example: Java v1, Python 2.3, .NET Framework 3.0).';
    public const LABEL = 'runtimePlatform';
    public const NAME = 'schema:runtimePlatform';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['SoftwareSourceCode' => 'Jolicode\SchemaOrg\Type\SoftwareSourceCodeModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
