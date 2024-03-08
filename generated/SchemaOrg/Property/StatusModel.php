<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class StatusModel
{
    public const DESCRIPTION = 'The status of the study (enumerated).';
    public const LABEL = 'status';
    public const NAME = 'schema:status';
    public const VALUES = ['EventStatusTypeModel' => 'SchemaOrg\\Type\\EventStatusTypeModel', 'MedicalStudyStatusModel' => 'SchemaOrg\\Type\\MedicalStudyStatusModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['MedicalCondition' => 'SchemaOrg\\Type\\MedicalConditionModel', 'MedicalProcedure' => 'SchemaOrg\\Type\\MedicalProcedureModel', 'MedicalStudy' => 'SchemaOrg\\Type\\MedicalStudyModel'];
}
