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

final class RestPeriodsModel
{
    public const DESCRIPTION = 'How often one should break from the activity.';
    public const LABEL = 'restPeriods';
    public const NAME = 'schema:restPeriods';
    public const VALUES = ['QuantitativeValueModel' => 'Jolicode\SchemaOrg\Type\QuantitativeValueModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['ExercisePlan' => 'Jolicode\SchemaOrg\Type\ExercisePlanModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
