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

final class ToLocationModel
{
    public const DESCRIPTION = 'A sub property of location. The final location of the object or the agent after the action.';
    public const LABEL = 'toLocation';
    public const NAME = 'schema:toLocation';
    public const VALUES = ['PlaceModel' => 'SchemaOrg\Type\PlaceModel'];
    public const TYPES = ['ExerciseAction' => 'SchemaOrg\Type\ExerciseActionModel', 'InsertAction' => 'SchemaOrg\Type\InsertActionModel', 'MoveAction' => 'SchemaOrg\Type\MoveActionModel', 'TransferAction' => 'SchemaOrg\Type\TransferActionModel'];
}
