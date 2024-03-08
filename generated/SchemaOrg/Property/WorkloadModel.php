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

final class WorkloadModel
{
    public const DESCRIPTION = 'Quantitative measure of the physiologic output of the exercise; also referred to as energy expenditure.';
    public const LABEL = 'workload';
    public const NAME = 'schema:workload';
    public const VALUES = ['EnergyModel' => 'SchemaOrg\\Type\\EnergyModel', 'QuantitativeValueModel' => 'SchemaOrg\\Type\\QuantitativeValueModel'];
    public const TYPES = ['ExercisePlan' => 'SchemaOrg\\Type\\ExercisePlanModel'];
}
