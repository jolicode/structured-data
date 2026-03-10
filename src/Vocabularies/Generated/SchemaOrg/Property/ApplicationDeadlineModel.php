<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class ApplicationDeadlineModel
{
    public const DESCRIPTION = 'The date on which the program stops collecting applications for the next enrollment cycle. Flexible application deadlines (for example, a program with rolling admissions) can be described in a textual string, rather than as a DateTime.';
    public const LABEL = 'applicationDeadline';
    public const NAME = 'schema:applicationDeadline';
    public const VALUES = ['DateModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DateModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['EducationalOccupationalProgram' => 'Jolicode\Vocabularies\SchemaOrg\Type\EducationalOccupationalProgramModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
