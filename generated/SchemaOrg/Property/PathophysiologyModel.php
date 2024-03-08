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

final class PathophysiologyModel
{
    public const DESCRIPTION = 'Changes in the normal mechanical, physical, and biochemical functions that are associated with this activity or condition.';
    public const LABEL = 'pathophysiology';
    public const NAME = 'schema:pathophysiology';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['MedicalCondition' => 'SchemaOrg\Type\MedicalConditionModel', 'PhysicalActivity' => 'SchemaOrg\Type\PhysicalActivityModel'];
}
