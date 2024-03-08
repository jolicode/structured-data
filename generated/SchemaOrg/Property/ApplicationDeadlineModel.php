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

final class ApplicationDeadlineModel
{
    public const DESCRIPTION = 'The date at which the program stops collecting applications for the next enrollment cycle.';
    public const LABEL = 'applicationDeadline';
    public const NAME = 'schema:applicationDeadline';
    public const VALUES = ['DateModel' => 'SchemaOrg\Type\DateModel'];
    public const TYPES = ['EducationalOccupationalProgram' => 'SchemaOrg\Type\EducationalOccupationalProgramModel'];
}
