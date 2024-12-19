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

final class ToLocationModel
{
    public const DESCRIPTION = 'A sub property of location. The final location of the object or the agent after the action.';
    public const LABEL = 'toLocation';
    public const NAME = 'schema:toLocation';
    public const VALUES = ['PlaceModel' => 'Jolicode\SchemaOrg\Type\PlaceModel'];
    public const TYPES = ['ExerciseAction' => 'Jolicode\SchemaOrg\Type\ExerciseActionModel', 'InsertAction' => 'Jolicode\SchemaOrg\Type\InsertActionModel', 'MoveAction' => 'Jolicode\SchemaOrg\Type\MoveActionModel', 'TransferAction' => 'Jolicode\SchemaOrg\Type\TransferActionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
