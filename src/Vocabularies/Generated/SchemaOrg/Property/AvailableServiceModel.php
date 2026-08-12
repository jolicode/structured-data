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

final class AvailableServiceModel
{
    public const DESCRIPTION = 'A medical service available from this provider.';
    public const LABEL = 'availableService';
    public const NAME = 'schema:availableService';
    public const VALUES = ['MedicalProcedureModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MedicalProcedureModel', 'MedicalTestModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MedicalTestModel', 'MedicalTherapyModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MedicalTherapyModel'];
    public const TYPES = ['Hospital' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\HospitalModel', 'MedicalClinic' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MedicalClinicModel', 'Physician' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PhysicianModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
