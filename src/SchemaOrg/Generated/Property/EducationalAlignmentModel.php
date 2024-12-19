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

final class EducationalAlignmentModel
{
    public const DESCRIPTION = 'An alignment to an established educational framework.

This property should not be used where the nature of the alignment can be described using a simple property, for example to express that a resource [[teaches]] or [[assesses]] a competency.';
    public const LABEL = 'educationalAlignment';
    public const NAME = 'schema:educationalAlignment';
    public const VALUES = ['AlignmentObjectModel' => 'Jolicode\SchemaOrg\Type\AlignmentObjectModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\SchemaOrg\Type\CreativeWorkModel', 'LearningResource' => 'Jolicode\SchemaOrg\Type\LearningResourceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
