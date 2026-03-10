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

final class MedicalSpecialtyModel
{
    public const DESCRIPTION = 'A medical specialty of the provider.';
    public const LABEL = 'medicalSpecialty';
    public const NAME = 'schema:medicalSpecialty';
    public const VALUES = ['MedicalSpecialtyModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MedicalSpecialtyModel'];
    public const TYPES = ['Hospital' => 'Jolicode\Vocabularies\SchemaOrg\Type\HospitalModel', 'MedicalClinic' => 'Jolicode\Vocabularies\SchemaOrg\Type\MedicalClinicModel', 'MedicalOrganization' => 'Jolicode\Vocabularies\SchemaOrg\Type\MedicalOrganizationModel', 'Physician' => 'Jolicode\Vocabularies\SchemaOrg\Type\PhysicianModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
