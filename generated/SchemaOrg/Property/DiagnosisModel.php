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

final class DiagnosisModel
{
    public const DESCRIPTION = 'One or more alternative conditions considered in the differential diagnosis process as output of a diagnosis process.';
    public const LABEL = 'diagnosis';
    public const NAME = 'schema:diagnosis';
    public const VALUES = ['MedicalConditionModel' => 'SchemaOrg\Type\MedicalConditionModel'];
    public const TYPES = ['DDxElement' => 'SchemaOrg\Type\DDxElementModel', 'Patient' => 'SchemaOrg\Type\PatientModel'];
}
