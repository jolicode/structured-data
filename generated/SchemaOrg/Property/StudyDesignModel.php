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

final class StudyDesignModel
{
    public const DESCRIPTION = 'Specifics about the observational study design (enumerated).';
    public const LABEL = 'studyDesign';
    public const NAME = 'schema:studyDesign';
    public const VALUES = ['MedicalObservationalStudyDesignModel' => 'SchemaOrg\Type\MedicalObservationalStudyDesignModel'];
    public const TYPES = ['MedicalObservationalStudy' => 'SchemaOrg\Type\MedicalObservationalStudyModel'];
}
