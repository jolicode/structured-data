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

final class AvailableServiceModel
{
    public const DESCRIPTION = 'A medical service available from this provider.';
    public const LABEL = 'availableService';
    public const NAME = 'schema:availableService';
    public const VALUES = ['MedicalProcedureModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MedicalProcedureModel', 'MedicalTestModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MedicalTestModel', 'MedicalTherapyModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MedicalTherapyModel'];
    public const TYPES = ['Hospital' => 'Jolicode\Vocabularies\SchemaOrg\Type\HospitalModel', 'MedicalClinic' => 'Jolicode\Vocabularies\SchemaOrg\Type\MedicalClinicModel', 'Physician' => 'Jolicode\Vocabularies\SchemaOrg\Type\PhysicianModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
