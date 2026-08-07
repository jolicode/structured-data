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

final class StudySubjectModel
{
    public const DESCRIPTION = 'A subject of the study, i.e. one of the medical conditions, therapies, devices, drugs, etc. investigated by the study.';
    public const LABEL = 'studySubject';
    public const NAME = 'schema:studySubject';
    public const VALUES = ['MedicalEntityModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MedicalEntityModel'];
    public const TYPES = ['MedicalStudy' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MedicalStudyModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
