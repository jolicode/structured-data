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

final class HealthConditionModel
{
    public const DESCRIPTION = 'Specifying the health condition(s) of a patient, medical study, or other target audience.';
    public const LABEL = 'healthCondition';
    public const NAME = 'schema:healthCondition';
    public const VALUES = ['MedicalConditionModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MedicalConditionModel'];
    public const TYPES = ['MedicalStudy' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MedicalStudyModel', 'Patient' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PatientModel', 'PeopleAudience' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PeopleAudienceModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
