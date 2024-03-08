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

final class EducationalLevelModel
{
    public const DESCRIPTION = 'The level in terms of progression through an educational or training context. Examples of educational levels include \'beginner\', \'intermediate\' or \'advanced\', and formal sets of level indicators.';
    public const LABEL = 'educationalLevel';
    public const NAME = 'schema:educationalLevel';
    public const VALUES = ['DefinedTermModel' => 'SchemaOrg\Type\DefinedTermModel', 'TextModel' => 'SchemaOrg\Type\TextModel', 'URLModel' => 'SchemaOrg\Type\URLModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\Type\CreativeWorkModel', 'EducationEvent' => 'SchemaOrg\Type\EducationEventModel', 'EducationalOccupationalCredential' => 'SchemaOrg\Type\EducationalOccupationalCredentialModel', 'LearningResource' => 'SchemaOrg\Type\LearningResourceModel'];
}
