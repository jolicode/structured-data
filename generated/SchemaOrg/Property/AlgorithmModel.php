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

final class AlgorithmModel
{
    public const DESCRIPTION = 'The algorithm or rules to follow to compute the score.';
    public const LABEL = 'algorithm';
    public const NAME = 'schema:algorithm';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['MedicalRiskScore' => 'SchemaOrg\\Type\\MedicalRiskScoreModel'];
}
