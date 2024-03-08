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

final class ExerciseCourseModel
{
    public const DESCRIPTION = 'A sub property of location. The course where this action was taken.';
    public const LABEL = 'exerciseCourse';
    public const NAME = 'schema:exerciseCourse';
    public const VALUES = ['PlaceModel' => 'SchemaOrg\Type\PlaceModel'];
    public const TYPES = ['ExerciseAction' => 'SchemaOrg\Type\ExerciseActionModel'];
}
