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

final class EducationalUseModel
{
    public const DESCRIPTION = 'The purpose of a work in the context of education; for example, \'assignment\', \'group work\'.';
    public const LABEL = 'educationalUse';
    public const NAME = 'schema:educationalUse';
    public const VALUES = ['DefinedTermModel' => 'Jolicode\SchemaOrg\Type\DefinedTermModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\SchemaOrg\Type\CreativeWorkModel', 'LearningResource' => 'Jolicode\SchemaOrg\Type\LearningResourceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
