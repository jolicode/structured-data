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

final class StudyModel
{
    public const DESCRIPTION = 'A medical study or trial related to this entity.';
    public const LABEL = 'study';
    public const NAME = 'schema:study';
    public const VALUES = ['MedicalStudyModel' => 'SchemaOrg\Type\MedicalStudyModel'];
    public const TYPES = ['MedicalEntity' => 'SchemaOrg\Type\MedicalEntityModel'];
}
