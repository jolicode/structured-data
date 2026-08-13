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

final class LegalStatusModel
{
    public const DESCRIPTION = 'The drug or supplement\'s legal status, including any controlled substance schedules that apply.';
    public const LABEL = 'legalStatus';
    public const NAME = 'schema:legalStatus';
    public const VALUES = ['DrugLegalStatusModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DrugLegalStatusModel', 'MedicalEnumerationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MedicalEnumerationModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['DietarySupplement' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DietarySupplementModel', 'Drug' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DrugModel', 'MedicalEntity' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MedicalEntityModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
