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

final class MaximumEnrollmentModel
{
    public const DESCRIPTION = 'The maximum number of students who may be enrolled in the program.';
    public const LABEL = 'maximumEnrollment';
    public const NAME = 'schema:maximumEnrollment';
    public const VALUES = ['IntegerModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\IntegerModel'];
    public const TYPES = ['EducationalOccupationalProgram' => 'Jolicode\Vocabularies\SchemaOrg\Type\EducationalOccupationalProgramModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
