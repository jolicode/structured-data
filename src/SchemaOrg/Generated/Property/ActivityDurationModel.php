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

final class ActivityDurationModel
{
    public const DESCRIPTION = 'Length of time to engage in the activity.';
    public const LABEL = 'activityDuration';
    public const NAME = 'schema:activityDuration';
    public const VALUES = ['DurationModel' => 'Jolicode\SchemaOrg\Type\DurationModel', 'QuantitativeValueModel' => 'Jolicode\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['ExercisePlan' => 'Jolicode\SchemaOrg\Type\ExercisePlanModel'];
}
