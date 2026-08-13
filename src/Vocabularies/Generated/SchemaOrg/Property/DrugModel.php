<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class DrugModel
{
    public const DESCRIPTION = 'Specifying a drug or medicine used in a medication procedure.';
    public const LABEL = 'drug';
    public const NAME = 'schema:drug';
    public const VALUES = ['DrugModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DrugModel'];
    public const TYPES = ['DrugClass' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DrugClassModel', 'MedicalCondition' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MedicalConditionModel', 'Patient' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PatientModel', 'TherapeuticProcedure' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TherapeuticProcedureModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
