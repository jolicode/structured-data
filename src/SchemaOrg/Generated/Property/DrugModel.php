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

final class DrugModel
{
    public const DESCRIPTION = 'Specifying a drug or medicine used in a medication procedure.';
    public const LABEL = 'drug';
    public const NAME = 'schema:drug';
    public const VALUES = ['DrugModel' => 'Jolicode\SchemaOrg\Type\DrugModel'];
    public const TYPES = ['DrugClass' => 'Jolicode\SchemaOrg\Type\DrugClassModel', 'MedicalCondition' => 'Jolicode\SchemaOrg\Type\MedicalConditionModel', 'Patient' => 'Jolicode\SchemaOrg\Type\PatientModel', 'TherapeuticProcedure' => 'Jolicode\SchemaOrg\Type\TherapeuticProcedureModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
