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

final class StageModel
{
    public const DESCRIPTION = 'The stage of the condition, if applicable.';
    public const LABEL = 'stage';
    public const NAME = 'schema:stage';
    public const VALUES = ['MedicalConditionStageModel' => 'Jolicode\SchemaOrg\Type\MedicalConditionStageModel'];
    public const TYPES = ['MedicalCondition' => 'Jolicode\SchemaOrg\Type\MedicalConditionModel'];
}
