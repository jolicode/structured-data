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

final class CodeRepositoryModel
{
    public const DESCRIPTION = 'Link to the repository where the un-compiled, human readable code and related code is located (SVN, GitHub, CodePlex).';
    public const LABEL = 'codeRepository';
    public const NAME = 'schema:codeRepository';
    public const VALUES = ['URLModel' => 'SchemaOrg\\Type\\URLModel'];
    public const TYPES = ['SoftwareSourceCode' => 'SchemaOrg\\Type\\SoftwareSourceCodeModel'];
}
