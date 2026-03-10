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

final class StatusModel
{
    public const DESCRIPTION = 'The status of the study (enumerated).';
    public const LABEL = 'status';
    public const NAME = 'schema:status';
    public const VALUES = ['EventStatusTypeModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\EventStatusTypeModel', 'MedicalStudyStatusModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MedicalStudyStatusModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['MedicalCondition' => 'Jolicode\Vocabularies\SchemaOrg\Type\MedicalConditionModel', 'MedicalProcedure' => 'Jolicode\Vocabularies\SchemaOrg\Type\MedicalProcedureModel', 'MedicalStudy' => 'Jolicode\Vocabularies\SchemaOrg\Type\MedicalStudyModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
