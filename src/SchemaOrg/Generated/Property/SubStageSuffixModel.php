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

final class SubStageSuffixModel
{
    public const DESCRIPTION = 'The substage, e.g. \'a\' for Stage IIIa.';
    public const LABEL = 'subStageSuffix';
    public const NAME = 'schema:subStageSuffix';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['MedicalConditionStage' => 'Jolicode\SchemaOrg\Type\MedicalConditionStageModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
