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

final class AssemblyModel
{
    public const DESCRIPTION = 'Library file name, e.g., mscorlib.dll, system.web.dll.';
    public const LABEL = 'assembly';
    public const NAME = 'schema:assembly';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['APIReference' => 'SchemaOrg\Type\APIReferenceModel'];
}
