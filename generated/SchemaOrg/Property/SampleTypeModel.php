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

final class SampleTypeModel
{
    public const DESCRIPTION = 'What type of code sample: full (compile ready) solution, code snippet, inline code, scripts, template.';
    public const LABEL = 'sampleType';
    public const NAME = 'schema:sampleType';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['SoftwareSourceCode' => 'SchemaOrg\\Type\\SoftwareSourceCodeModel'];
}
