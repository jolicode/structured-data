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

final class UsedToDiagnoseModel
{
    public const DESCRIPTION = 'A condition the test is used to diagnose.';
    public const LABEL = 'usedToDiagnose';
    public const NAME = 'schema:usedToDiagnose';
    public const VALUES = ['MedicalConditionModel' => 'Jolicode\SchemaOrg\Type\MedicalConditionModel'];
    public const TYPES = ['MedicalTest' => 'Jolicode\SchemaOrg\Type\MedicalTestModel'];
}
