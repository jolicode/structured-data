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

final class EducationalCredentialAwardedModel
{
    public const DESCRIPTION = 'A description of the qualification, award, certificate, diploma or other educational credential awarded as a consequence of successful completion of this course or program.';
    public const LABEL = 'educationalCredentialAwarded';
    public const NAME = 'schema:educationalCredentialAwarded';
    public const VALUES = ['EducationalOccupationalCredentialModel' => 'SchemaOrg\\Type\\EducationalOccupationalCredentialModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel', 'URLModel' => 'SchemaOrg\\Type\\URLModel'];
    public const TYPES = ['Course' => 'SchemaOrg\\Type\\CourseModel', 'EducationalOccupationalProgram' => 'SchemaOrg\\Type\\EducationalOccupationalProgramModel'];
}
