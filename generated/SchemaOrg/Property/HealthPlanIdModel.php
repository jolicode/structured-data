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

final class HealthPlanIdModel
{
    public const DESCRIPTION = 'The 14-character, HIOS-generated Plan ID number. (Plan IDs must be unique, even across different markets.)';
    public const LABEL = 'healthPlanId';
    public const NAME = 'schema:healthPlanId';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['HealthInsurancePlan' => 'SchemaOrg\\Type\\HealthInsurancePlanModel'];
}
