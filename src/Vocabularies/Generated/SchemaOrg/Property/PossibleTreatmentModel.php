<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class PossibleTreatmentModel
{
    public const DESCRIPTION = 'A possible treatment to address this condition, sign or symptom.';
    public const LABEL = 'possibleTreatment';
    public const NAME = 'schema:possibleTreatment';
    public const VALUES = ['DrugClassModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DrugClassModel', 'DrugModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DrugModel', 'LifestyleModificationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\LifestyleModificationModel', 'MedicalTherapyModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MedicalTherapyModel'];
    public const TYPES = ['MedicalCondition' => 'Jolicode\Vocabularies\SchemaOrg\Type\MedicalConditionModel', 'MedicalSignOrSymptom' => 'Jolicode\Vocabularies\SchemaOrg\Type\MedicalSignOrSymptomModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
