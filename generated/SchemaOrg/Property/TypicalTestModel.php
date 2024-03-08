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

final class TypicalTestModel
{
    public const DESCRIPTION = 'A medical test typically performed given this condition.';
    public const LABEL = 'typicalTest';
    public const NAME = 'schema:typicalTest';
    public const VALUES = ['MedicalTestModel' => 'SchemaOrg\\Type\\MedicalTestModel'];
    public const TYPES = ['MedicalCondition' => 'SchemaOrg\\Type\\MedicalConditionModel'];
}
