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

final class TimeOfDayModel
{
    public const DESCRIPTION = 'The time of day the program normally runs. For example, "evenings".';
    public const LABEL = 'timeOfDay';
    public const NAME = 'schema:timeOfDay';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['EducationalOccupationalProgram' => 'SchemaOrg\\Type\\EducationalOccupationalProgramModel'];
}
