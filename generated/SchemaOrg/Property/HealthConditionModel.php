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

final class HealthConditionModel
{
    public const DESCRIPTION = 'Specifying the health condition(s) of a patient, medical study, or other target audience.';
    public const LABEL = 'healthCondition';
    public const NAME = 'schema:healthCondition';
    public const VALUES = ['MedicalConditionModel' => 'SchemaOrg\Type\MedicalConditionModel'];
    public const TYPES = ['MedicalStudy' => 'SchemaOrg\Type\MedicalStudyModel', 'Patient' => 'SchemaOrg\Type\PatientModel', 'PeopleAudience' => 'SchemaOrg\Type\PeopleAudienceModel'];
}
