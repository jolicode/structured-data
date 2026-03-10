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

final class ActivityDurationModel
{
    public const DESCRIPTION = 'Length of time to engage in the activity.';
    public const LABEL = 'activityDuration';
    public const NAME = 'schema:activityDuration';
    public const VALUES = ['DurationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DurationModel', 'QuantitativeValueModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['ExercisePlan' => 'Jolicode\Vocabularies\SchemaOrg\Type\ExercisePlanModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
