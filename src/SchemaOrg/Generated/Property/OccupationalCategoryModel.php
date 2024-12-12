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

final class OccupationalCategoryModel
{
    public const DESCRIPTION = 'A category describing the job, preferably using a term from a taxonomy such as [BLS O*NET-SOC](http://www.onetcenter.org/taxonomy.html), [ISCO-08](https://www.ilo.org/public/english/bureau/stat/isco/isco08/) or similar, with the property repeated for each applicable value. Ideally the taxonomy should be identified, and both the textual label and formal code for the category should be provided.\n
Note: for historical reasons, any textual label and formal code provided as a literal may be assumed to be from O*NET-SOC.';
    public const LABEL = 'occupationalCategory';
    public const NAME = 'schema:occupationalCategory';
    public const VALUES = ['CategoryCodeModel' => 'Jolicode\SchemaOrg\Type\CategoryCodeModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['EducationalOccupationalProgram' => 'Jolicode\SchemaOrg\Type\EducationalOccupationalProgramModel', 'JobPosting' => 'Jolicode\SchemaOrg\Type\JobPostingModel', 'Occupation' => 'Jolicode\SchemaOrg\Type\OccupationModel', 'Physician' => 'Jolicode\SchemaOrg\Type\PhysicianModel', 'WorkBasedProgram' => 'Jolicode\SchemaOrg\Type\WorkBasedProgramModel'];
}
