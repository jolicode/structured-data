<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class RestPeriodsModel
{
    public const DESCRIPTION = 'How often one should break from the activity.';
    public const LABEL = 'restPeriods';
    public const NAME = 'schema:restPeriods';
    public const VALUES = ['QuantitativeValueModel' => 'SchemaOrg\\Type\\QuantitativeValueModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['ExercisePlan' => 'SchemaOrg\\Type\\ExercisePlanModel'];
}
