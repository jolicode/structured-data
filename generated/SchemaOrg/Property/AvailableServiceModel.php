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

final class AvailableServiceModel
{
    public const DESCRIPTION = 'A medical service available from this provider.';
    public const LABEL = 'availableService';
    public const NAME = 'schema:availableService';
    public const VALUES = ['MedicalProcedureModel' => 'SchemaOrg\Type\MedicalProcedureModel', 'MedicalTestModel' => 'SchemaOrg\Type\MedicalTestModel', 'MedicalTherapyModel' => 'SchemaOrg\Type\MedicalTherapyModel'];
    public const TYPES = ['Hospital' => 'SchemaOrg\Type\HospitalModel', 'MedicalClinic' => 'SchemaOrg\Type\MedicalClinicModel', 'Physician' => 'SchemaOrg\Type\PhysicianModel'];
}
