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

final class EducationalLevelModel
{
    public const DESCRIPTION = 'The level in terms of progression through an educational or training context. Examples of educational levels include \'beginner\', \'intermediate\' or \'advanced\', and formal sets of level indicators.';
    public const LABEL = 'educationalLevel';
    public const NAME = 'schema:educationalLevel';
    public const VALUES = ['DefinedTermModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DefinedTermModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel', 'URLModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\URLModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\Vocabularies\SchemaOrg\Type\CreativeWorkModel', 'EducationEvent' => 'Jolicode\Vocabularies\SchemaOrg\Type\EducationEventModel', 'EducationalOccupationalCredential' => 'Jolicode\Vocabularies\SchemaOrg\Type\EducationalOccupationalCredentialModel', 'LearningResource' => 'Jolicode\Vocabularies\SchemaOrg\Type\LearningResourceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
