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

final class ExercisePlanModel
{
    public const DESCRIPTION = 'A sub property of instrument. The exercise plan used on this action.';
    public const LABEL = 'exercisePlan';
    public const NAME = 'schema:exercisePlan';
    public const VALUES = ['ExercisePlanModel' => 'Jolicode\SchemaOrg\Type\ExercisePlanModel'];
    public const TYPES = ['ExerciseAction' => 'Jolicode\SchemaOrg\Type\ExerciseActionModel'];
}
