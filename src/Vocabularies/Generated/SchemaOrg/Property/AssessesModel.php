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

final class AssessesModel
{
    public const DESCRIPTION = 'The item being described is intended to assess the competency or learning outcome defined by the referenced term.';
    public const LABEL = 'assesses';
    public const NAME = 'schema:assesses';
    public const VALUES = ['DefinedTermModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DefinedTermModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\Vocabularies\SchemaOrg\Type\CreativeWorkModel', 'EducationEvent' => 'Jolicode\Vocabularies\SchemaOrg\Type\EducationEventModel', 'LearningResource' => 'Jolicode\Vocabularies\SchemaOrg\Type\LearningResourceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
