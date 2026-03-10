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

final class InstructorModel
{
    public const DESCRIPTION = 'A person assigned to instruct or provide instructional assistance for the [[CourseInstance]].';
    public const LABEL = 'instructor';
    public const NAME = 'schema:instructor';
    public const VALUES = ['PersonModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['CourseInstance' => 'Jolicode\Vocabularies\SchemaOrg\Type\CourseInstanceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
