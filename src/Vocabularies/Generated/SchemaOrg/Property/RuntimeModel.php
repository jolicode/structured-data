<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class RuntimeModel
{
    public const DESCRIPTION = 'Runtime platform or script interpreter dependencies (example: Java v1, Python 2.3, .NET Framework 3.0).';
    public const LABEL = 'runtime';
    public const NAME = 'schema:runtime';
    public const VALUES = ['TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['SoftwareSourceCode' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\SoftwareSourceCodeModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = 'runtimePlatform';
}
