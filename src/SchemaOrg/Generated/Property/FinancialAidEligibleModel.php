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

final class FinancialAidEligibleModel
{
    public const DESCRIPTION = 'A financial aid type or program which students may use to pay for tuition or fees associated with the program.';
    public const LABEL = 'financialAidEligible';
    public const NAME = 'schema:financialAidEligible';
    public const VALUES = ['DefinedTermModel' => 'Jolicode\SchemaOrg\Type\DefinedTermModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Course' => 'Jolicode\SchemaOrg\Type\CourseModel', 'EducationalOccupationalProgram' => 'Jolicode\SchemaOrg\Type\EducationalOccupationalProgramModel'];
}
