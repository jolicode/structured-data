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

final class EstimatesRiskOfModel
{
    public const DESCRIPTION = 'The condition, complication, or symptom whose risk is being estimated.';
    public const LABEL = 'estimatesRiskOf';
    public const NAME = 'schema:estimatesRiskOf';
    public const VALUES = ['MedicalEntityModel' => 'Jolicode\SchemaOrg\Type\MedicalEntityModel'];
    public const TYPES = ['MedicalRiskEstimator' => 'Jolicode\SchemaOrg\Type\MedicalRiskEstimatorModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
