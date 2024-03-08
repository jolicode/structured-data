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

final class CompetencyRequiredModel
{
    public const DESCRIPTION = 'Knowledge, skill, ability or personal attribute that must be demonstrated by a person or other entity in order to do something such as earn an Educational Occupational Credential or understand a LearningResource.';
    public const LABEL = 'competencyRequired';
    public const NAME = 'schema:competencyRequired';
    public const VALUES = ['DefinedTermModel' => 'SchemaOrg\Type\DefinedTermModel', 'TextModel' => 'SchemaOrg\Type\TextModel', 'URLModel' => 'SchemaOrg\Type\URLModel'];
    public const TYPES = ['EducationalOccupationalCredential' => 'SchemaOrg\Type\EducationalOccupationalCredentialModel', 'LearningResource' => 'SchemaOrg\Type\LearningResourceModel'];
}
