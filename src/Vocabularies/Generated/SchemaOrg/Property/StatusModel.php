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

final class StatusModel
{
    public const DESCRIPTION = 'The status of the study (enumerated).';
    public const LABEL = 'status';
    public const NAME = 'schema:status';
    public const VALUES = ['EventStatusTypeModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\EventStatusTypeModel', 'MedicalStudyStatusModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MedicalStudyStatusModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['MedicalCondition' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MedicalConditionModel', 'MedicalProcedure' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MedicalProcedureModel', 'MedicalStudy' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MedicalStudyModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
