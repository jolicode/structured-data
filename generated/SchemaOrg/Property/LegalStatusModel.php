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

final class LegalStatusModel
{
    public const DESCRIPTION = 'The drug or supplement\'s legal status, including any controlled substance schedules that apply.';
    public const LABEL = 'legalStatus';
    public const NAME = 'schema:legalStatus';
    public const VALUES = ['DrugLegalStatusModel' => 'SchemaOrg\Type\DrugLegalStatusModel', 'MedicalEnumerationModel' => 'SchemaOrg\Type\MedicalEnumerationModel', 'TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['DietarySupplement' => 'SchemaOrg\Type\DietarySupplementModel', 'Drug' => 'SchemaOrg\Type\DrugModel', 'MedicalEntity' => 'SchemaOrg\Type\MedicalEntityModel'];
}
