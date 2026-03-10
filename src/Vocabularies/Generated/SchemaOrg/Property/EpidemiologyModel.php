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

final class EpidemiologyModel
{
    public const DESCRIPTION = 'The characteristics of associated patients, such as age, gender, race etc.';
    public const LABEL = 'epidemiology';
    public const NAME = 'schema:epidemiology';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['MedicalCondition' => 'Jolicode\Vocabularies\SchemaOrg\Type\MedicalConditionModel', 'PhysicalActivity' => 'Jolicode\Vocabularies\SchemaOrg\Type\PhysicalActivityModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
