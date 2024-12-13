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

final class StatusModel
{
    public const DESCRIPTION = 'The status of the study (enumerated).';
    public const LABEL = 'status';
    public const NAME = 'schema:status';
    public const VALUES = ['EventStatusTypeModel' => 'Jolicode\SchemaOrg\Type\EventStatusTypeModel', 'MedicalStudyStatusModel' => 'Jolicode\SchemaOrg\Type\MedicalStudyStatusModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['MedicalCondition' => 'Jolicode\SchemaOrg\Type\MedicalConditionModel', 'MedicalProcedure' => 'Jolicode\SchemaOrg\Type\MedicalProcedureModel', 'MedicalStudy' => 'Jolicode\SchemaOrg\Type\MedicalStudyModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
