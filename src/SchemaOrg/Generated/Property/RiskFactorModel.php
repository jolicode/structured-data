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

final class RiskFactorModel
{
    public const DESCRIPTION = 'A modifiable or non-modifiable factor that increases the risk of a patient contracting this condition, e.g. age,  coexisting condition.';
    public const LABEL = 'riskFactor';
    public const NAME = 'schema:riskFactor';
    public const VALUES = ['MedicalRiskFactorModel' => 'Jolicode\SchemaOrg\Type\MedicalRiskFactorModel'];
    public const TYPES = ['MedicalCondition' => 'Jolicode\SchemaOrg\Type\MedicalConditionModel'];
}
