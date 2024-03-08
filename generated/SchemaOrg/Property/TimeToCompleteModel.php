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

final class TimeToCompleteModel
{
    public const DESCRIPTION = 'The expected length of time to complete the program if attending full-time.';
    public const LABEL = 'timeToComplete';
    public const NAME = 'schema:timeToComplete';
    public const VALUES = ['DurationModel' => 'SchemaOrg\\Type\\DurationModel'];
    public const TYPES = ['EducationalOccupationalProgram' => 'SchemaOrg\\Type\\EducationalOccupationalProgramModel'];
}
