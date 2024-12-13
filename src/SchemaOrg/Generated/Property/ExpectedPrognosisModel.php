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

final class ExpectedPrognosisModel
{
    public const DESCRIPTION = 'The likely outcome in either the short term or long term of the medical condition.';
    public const LABEL = 'expectedPrognosis';
    public const NAME = 'schema:expectedPrognosis';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['MedicalCondition' => 'Jolicode\SchemaOrg\Type\MedicalConditionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
