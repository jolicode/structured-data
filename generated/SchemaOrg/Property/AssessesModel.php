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

final class AssessesModel
{
    public const DESCRIPTION = 'The item being described is intended to assess the competency or learning outcome defined by the referenced term.';
    public const LABEL = 'assesses';
    public const NAME = 'schema:assesses';
    public const VALUES = ['DefinedTermModel' => 'SchemaOrg\Type\DefinedTermModel', 'TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\Type\CreativeWorkModel', 'EducationEvent' => 'SchemaOrg\Type\EducationEventModel', 'LearningResource' => 'SchemaOrg\Type\LearningResourceModel'];
}
