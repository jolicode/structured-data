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

final class DrugModel
{
    public const DESCRIPTION = 'Specifying a drug or medicine used in a medication procedure.';
    public const LABEL = 'drug';
    public const NAME = 'schema:drug';
    public const VALUES = ['DrugModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DrugModel'];
    public const TYPES = ['DrugClass' => 'Jolicode\Vocabularies\SchemaOrg\Type\DrugClassModel', 'MedicalCondition' => 'Jolicode\Vocabularies\SchemaOrg\Type\MedicalConditionModel', 'Patient' => 'Jolicode\Vocabularies\SchemaOrg\Type\PatientModel', 'TherapeuticProcedure' => 'Jolicode\Vocabularies\SchemaOrg\Type\TherapeuticProcedureModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
