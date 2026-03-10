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

final class StudyModel
{
    public const DESCRIPTION = 'A medical study or trial related to this entity.';
    public const LABEL = 'study';
    public const NAME = 'schema:study';
    public const VALUES = ['MedicalStudyModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MedicalStudyModel'];
    public const TYPES = ['MedicalEntity' => 'Jolicode\Vocabularies\SchemaOrg\Type\MedicalEntityModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
