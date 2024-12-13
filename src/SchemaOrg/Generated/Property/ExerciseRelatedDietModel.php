<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class ExerciseRelatedDietModel
{
    public const DESCRIPTION = 'A sub property of instrument. The diet used in this action.';
    public const LABEL = 'exerciseRelatedDiet';
    public const NAME = 'schema:exerciseRelatedDiet';
    public const VALUES = ['DietModel' => 'Jolicode\SchemaOrg\Type\DietModel'];
    public const TYPES = ['ExerciseAction' => 'Jolicode\SchemaOrg\Type\ExerciseActionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
