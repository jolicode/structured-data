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

final class ProgramTypeModel
{
    public const DESCRIPTION = 'The type of educational or occupational program. For example, classroom, internship, alternance, etc.';
    public const LABEL = 'programType';
    public const NAME = 'schema:programType';
    public const VALUES = ['DefinedTermModel' => 'SchemaOrg\\Type\\DefinedTermModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['EducationalOccupationalProgram' => 'SchemaOrg\\Type\\EducationalOccupationalProgramModel'];
}
