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

final class MedicalSpecialtyModel
{
    public const DESCRIPTION = 'A medical specialty of the provider.';
    public const LABEL = 'medicalSpecialty';
    public const NAME = 'schema:medicalSpecialty';
    public const VALUES = ['MedicalSpecialtyModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MedicalSpecialtyModel'];
    public const TYPES = ['Hospital' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\HospitalModel', 'MedicalClinic' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MedicalClinicModel', 'MedicalOrganization' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MedicalOrganizationModel', 'Physician' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PhysicianModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
