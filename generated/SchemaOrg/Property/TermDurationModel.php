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

final class TermDurationModel
{
    public const DESCRIPTION = 'The amount of time in a term as defined by the institution. A term is a length of time where students take one or more classes. Semesters and quarters are common units for term.';
    public const LABEL = 'termDuration';
    public const NAME = 'schema:termDuration';
    public const VALUES = ['DurationModel' => 'SchemaOrg\\Type\\DurationModel'];
    public const TYPES = ['EducationalOccupationalProgram' => 'SchemaOrg\\Type\\EducationalOccupationalProgramModel'];
}
