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

final class DifferentialDiagnosisModel
{
    public const DESCRIPTION = 'One of a set of differential diagnoses for the condition. Specifically, a closely-related or competing diagnosis typically considered later in the cognitive process whereby this medical condition is distinguished from others most likely responsible for a similar collection of signs and symptoms to reach the most parsimonious diagnosis or diagnoses in a patient.';
    public const LABEL = 'differentialDiagnosis';
    public const NAME = 'schema:differentialDiagnosis';
    public const VALUES = ['DDxElementModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DDxElementModel'];
    public const TYPES = ['MedicalCondition' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MedicalConditionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
