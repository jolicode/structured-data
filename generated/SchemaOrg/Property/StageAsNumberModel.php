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

final class StageAsNumberModel
{
    public const DESCRIPTION = 'The stage represented as a number, e.g. 3.';
    public const LABEL = 'stageAsNumber';
    public const NAME = 'schema:stageAsNumber';
    public const VALUES = ['NumberModel' => 'SchemaOrg\Type\NumberModel'];
    public const TYPES = ['MedicalConditionStage' => 'SchemaOrg\Type\MedicalConditionStageModel'];
}
