<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class ApplicationStartDateModel
{
    public const DESCRIPTION = 'The date at which the program begins collecting applications for the next enrollment cycle.';
    public const LABEL = 'applicationStartDate';
    public const NAME = 'schema:applicationStartDate';
    public const VALUES = ['DateModel' => 'Jolicode\SchemaOrg\Type\DateModel'];
    public const TYPES = ['EducationalOccupationalProgram' => 'Jolicode\SchemaOrg\Type\EducationalOccupationalProgramModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
