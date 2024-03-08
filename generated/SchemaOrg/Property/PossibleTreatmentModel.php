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

final class PossibleTreatmentModel
{
    public const DESCRIPTION = 'A possible treatment to address this condition, sign or symptom.';
    public const LABEL = 'possibleTreatment';
    public const NAME = 'schema:possibleTreatment';
    public const VALUES = ['MedicalTherapyModel' => 'SchemaOrg\Type\MedicalTherapyModel'];
    public const TYPES = ['MedicalCondition' => 'SchemaOrg\Type\MedicalConditionModel', 'MedicalSignOrSymptom' => 'SchemaOrg\Type\MedicalSignOrSymptomModel'];
}
