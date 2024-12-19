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

final class ExerciseTypeModel
{
    public const DESCRIPTION = 'Type(s) of exercise or activity, such as strength training, flexibility training, aerobics, cardiac rehabilitation, etc.';
    public const LABEL = 'exerciseType';
    public const NAME = 'schema:exerciseType';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['ExerciseAction' => 'Jolicode\SchemaOrg\Type\ExerciseActionModel', 'ExercisePlan' => 'Jolicode\SchemaOrg\Type\ExercisePlanModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
