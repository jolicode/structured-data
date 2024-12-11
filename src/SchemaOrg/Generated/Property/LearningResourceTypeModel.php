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

final class LearningResourceTypeModel
{
    public const DESCRIPTION = 'The predominant type or kind characterizing the learning resource. For example, \'presentation\', \'handout\'.';
    public const LABEL = 'learningResourceType';
    public const NAME = 'schema:learningResourceType';
    public const VALUES = ['DefinedTermModel' => 'Jolicode\SchemaOrg\Type\DefinedTermModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\SchemaOrg\Type\CreativeWorkModel', 'LearningResource' => 'Jolicode\SchemaOrg\Type\LearningResourceModel'];
}
