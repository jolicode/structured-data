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

final class EducationalUseModel
{
    public const DESCRIPTION = 'The purpose of a work in the context of education; for example, \'assignment\', \'group work\'.';
    public const LABEL = 'educationalUse';
    public const NAME = 'schema:educationalUse';
    public const VALUES = ['DefinedTermModel' => 'SchemaOrg\Type\DefinedTermModel', 'TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\Type\CreativeWorkModel', 'LearningResource' => 'SchemaOrg\Type\LearningResourceModel'];
}
