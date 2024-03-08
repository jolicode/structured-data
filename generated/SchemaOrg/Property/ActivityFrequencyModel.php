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

final class ActivityFrequencyModel
{
    public const DESCRIPTION = 'How often one should engage in the activity.';
    public const LABEL = 'activityFrequency';
    public const NAME = 'schema:activityFrequency';
    public const VALUES = ['QuantitativeValueModel' => 'SchemaOrg\Type\QuantitativeValueModel', 'TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['ExercisePlan' => 'SchemaOrg\Type\ExercisePlanModel'];
}
