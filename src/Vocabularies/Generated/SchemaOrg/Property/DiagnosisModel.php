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

final class DiagnosisModel
{
    public const DESCRIPTION = 'One or more alternative conditions considered in the differential diagnosis process as output of a diagnosis process.';
    public const LABEL = 'diagnosis';
    public const NAME = 'schema:diagnosis';
    public const VALUES = ['MedicalConditionModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MedicalConditionModel'];
    public const TYPES = ['DDxElement' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DDxElementModel', 'Patient' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PatientModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
