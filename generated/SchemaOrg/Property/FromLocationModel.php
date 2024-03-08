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

final class FromLocationModel
{
    public const DESCRIPTION = 'A sub property of location. The original location of the object or the agent before the action.';
    public const LABEL = 'fromLocation';
    public const NAME = 'schema:fromLocation';
    public const VALUES = ['PlaceModel' => 'SchemaOrg\Type\PlaceModel'];
    public const TYPES = ['ExerciseAction' => 'SchemaOrg\Type\ExerciseActionModel', 'MoveAction' => 'SchemaOrg\Type\MoveActionModel', 'TransferAction' => 'SchemaOrg\Type\TransferActionModel'];
}
