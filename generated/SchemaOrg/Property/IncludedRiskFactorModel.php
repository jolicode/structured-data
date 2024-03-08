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

final class IncludedRiskFactorModel
{
    public const DESCRIPTION = 'A modifiable or non-modifiable risk factor included in the calculation, e.g. age, coexisting condition.';
    public const LABEL = 'includedRiskFactor';
    public const NAME = 'schema:includedRiskFactor';
    public const VALUES = ['MedicalRiskFactorModel' => 'SchemaOrg\Type\MedicalRiskFactorModel'];
    public const TYPES = ['MedicalRiskEstimator' => 'SchemaOrg\Type\MedicalRiskEstimatorModel'];
}
