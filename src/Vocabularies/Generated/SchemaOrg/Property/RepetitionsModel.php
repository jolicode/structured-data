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

final class RepetitionsModel
{
    public const DESCRIPTION = 'Number of times one should repeat the activity.';
    public const LABEL = 'repetitions';
    public const NAME = 'schema:repetitions';
    public const VALUES = ['NumberModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\NumberModel', 'QuantitativeValueModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['ExercisePlan' => 'Jolicode\Vocabularies\SchemaOrg\Type\ExercisePlanModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
