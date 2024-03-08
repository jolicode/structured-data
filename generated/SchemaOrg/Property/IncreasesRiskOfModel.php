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

final class IncreasesRiskOfModel
{
    public const DESCRIPTION = 'The condition, complication, etc. influenced by this factor.';
    public const LABEL = 'increasesRiskOf';
    public const NAME = 'schema:increasesRiskOf';
    public const VALUES = ['MedicalEntityModel' => 'SchemaOrg\\Type\\MedicalEntityModel'];
    public const TYPES = ['MedicalRiskFactor' => 'SchemaOrg\\Type\\MedicalRiskFactorModel'];
}
