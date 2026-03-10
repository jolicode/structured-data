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

final class StudyLocationModel
{
    public const DESCRIPTION = 'The location in which the study is taking/took place.';
    public const LABEL = 'studyLocation';
    public const NAME = 'schema:studyLocation';
    public const VALUES = ['AdministrativeAreaModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\AdministrativeAreaModel'];
    public const TYPES = ['MedicalStudy' => 'Jolicode\Vocabularies\SchemaOrg\Type\MedicalStudyModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
