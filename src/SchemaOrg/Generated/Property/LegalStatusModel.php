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

final class LegalStatusModel
{
    public const DESCRIPTION = 'The drug or supplement\'s legal status, including any controlled substance schedules that apply.';
    public const LABEL = 'legalStatus';
    public const NAME = 'schema:legalStatus';
    public const VALUES = ['DrugLegalStatusModel' => 'Jolicode\SchemaOrg\Type\DrugLegalStatusModel', 'MedicalEnumerationModel' => 'Jolicode\SchemaOrg\Type\MedicalEnumerationModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['DietarySupplement' => 'Jolicode\SchemaOrg\Type\DietarySupplementModel', 'Drug' => 'Jolicode\SchemaOrg\Type\DrugModel', 'MedicalEntity' => 'Jolicode\SchemaOrg\Type\MedicalEntityModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
