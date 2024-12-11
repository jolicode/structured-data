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

final class CourseModel
{
    public const DESCRIPTION = 'A sub property of location. The course where this action was taken.';
    public const LABEL = 'course';
    public const NAME = 'schema:course';
    public const VALUES = ['PlaceModel' => 'Jolicode\SchemaOrg\Type\PlaceModel'];
    public const TYPES = ['ExerciseAction' => 'Jolicode\SchemaOrg\Type\ExerciseActionModel'];
}
