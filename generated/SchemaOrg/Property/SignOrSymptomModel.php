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

final class SignOrSymptomModel
{
    public const DESCRIPTION = 'A sign or symptom of this condition. Signs are objective or physically observable manifestations of the medical condition while symptoms are the subjective experience of the medical condition.';
    public const LABEL = 'signOrSymptom';
    public const NAME = 'schema:signOrSymptom';
    public const VALUES = ['MedicalSignOrSymptomModel' => 'SchemaOrg\\Type\\MedicalSignOrSymptomModel'];
    public const TYPES = ['MedicalCondition' => 'SchemaOrg\\Type\\MedicalConditionModel'];
}
