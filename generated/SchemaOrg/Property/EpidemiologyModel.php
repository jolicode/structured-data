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

final class EpidemiologyModel
{
    public const DESCRIPTION = 'The characteristics of associated patients, such as age, gender, race etc.';
    public const LABEL = 'epidemiology';
    public const NAME = 'schema:epidemiology';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['MedicalCondition' => 'SchemaOrg\Type\MedicalConditionModel', 'PhysicalActivity' => 'SchemaOrg\Type\PhysicalActivityModel'];
}
