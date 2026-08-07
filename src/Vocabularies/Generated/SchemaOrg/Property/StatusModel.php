<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class StatusModel
{
    public const DESCRIPTION = 'The status of the study (enumerated).';
    public const LABEL = 'status';
    public const NAME = 'schema:status';
    public const VALUES = ['EventStatusTypeModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\EventStatusTypeModel', 'MedicalStudyStatusModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MedicalStudyStatusModel', 'TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['MedicalCondition' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MedicalConditionModel', 'MedicalProcedure' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MedicalProcedureModel', 'MedicalStudy' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MedicalStudyModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
