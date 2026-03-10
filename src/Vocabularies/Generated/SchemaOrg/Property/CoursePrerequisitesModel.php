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

final class CoursePrerequisitesModel
{
    public const DESCRIPTION = 'Requirements for taking the Course. May be completion of another [[Course]] or a textual description like "permission of instructor". Requirements may be a pre-requisite competency, referenced using [[AlignmentObject]].';
    public const LABEL = 'coursePrerequisites';
    public const NAME = 'schema:coursePrerequisites';
    public const VALUES = ['AlignmentObjectModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\AlignmentObjectModel', 'CourseModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\CourseModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Course' => 'Jolicode\Vocabularies\SchemaOrg\Type\CourseModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
