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

final class MedicalSpecialtyModel
{
    public const DESCRIPTION = 'A medical specialty of the provider.';
    public const LABEL = 'medicalSpecialty';
    public const NAME = 'schema:medicalSpecialty';
    public const VALUES = ['MedicalSpecialtyModel' => 'SchemaOrg\Type\MedicalSpecialtyModel'];
    public const TYPES = ['Hospital' => 'SchemaOrg\Type\HospitalModel', 'MedicalClinic' => 'SchemaOrg\Type\MedicalClinicModel', 'MedicalOrganization' => 'SchemaOrg\Type\MedicalOrganizationModel', 'Physician' => 'SchemaOrg\Type\PhysicianModel'];
}
