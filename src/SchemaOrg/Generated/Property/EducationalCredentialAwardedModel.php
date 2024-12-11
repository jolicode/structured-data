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

final class EducationalCredentialAwardedModel
{
    public const DESCRIPTION = 'A description of the qualification, award, certificate, diploma or other educational credential awarded as a consequence of successful completion of this course or program.';
    public const LABEL = 'educationalCredentialAwarded';
    public const NAME = 'schema:educationalCredentialAwarded';
    public const VALUES = ['EducationalOccupationalCredentialModel' => 'Jolicode\SchemaOrg\Type\EducationalOccupationalCredentialModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel', 'URLModel' => 'Jolicode\SchemaOrg\Type\URLModel'];
    public const TYPES = ['Course' => 'Jolicode\SchemaOrg\Type\CourseModel', 'EducationalOccupationalProgram' => 'Jolicode\SchemaOrg\Type\EducationalOccupationalProgramModel'];
}
