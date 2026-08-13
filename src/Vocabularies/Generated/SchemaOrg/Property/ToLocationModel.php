<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class ToLocationModel
{
    public const DESCRIPTION = 'A sub property of location. The final location of the object or the agent after the action.';
    public const LABEL = 'toLocation';
    public const NAME = 'schema:toLocation';
    public const VALUES = ['PlaceModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PlaceModel'];
    public const TYPES = ['ExerciseAction' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ExerciseActionModel', 'InsertAction' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\InsertActionModel', 'MoveAction' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MoveActionModel', 'TransferAction' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TransferActionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
