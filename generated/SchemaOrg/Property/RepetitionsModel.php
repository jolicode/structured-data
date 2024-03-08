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

final class RepetitionsModel
{
    public const DESCRIPTION = 'Number of times one should repeat the activity.';
    public const LABEL = 'repetitions';
    public const NAME = 'schema:repetitions';
    public const VALUES = ['NumberModel' => 'SchemaOrg\Type\NumberModel', 'QuantitativeValueModel' => 'SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['ExercisePlan' => 'SchemaOrg\Type\ExercisePlanModel'];
}
