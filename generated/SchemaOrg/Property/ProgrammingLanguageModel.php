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

final class ProgrammingLanguageModel
{
    public const DESCRIPTION = 'The computer programming language.';
    public const LABEL = 'programmingLanguage';
    public const NAME = 'schema:programmingLanguage';
    public const VALUES = ['ComputerLanguageModel' => 'SchemaOrg\Type\ComputerLanguageModel', 'TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['SoftwareSourceCode' => 'SchemaOrg\Type\SoftwareSourceCodeModel'];
}
