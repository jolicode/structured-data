<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class FromLocationModel
{
    public const DESCRIPTION = 'A sub property of location. The original location of the object or the agent before the action.';
    public const LABEL = 'fromLocation';
    public const NAME = 'schema:fromLocation';
    public const VALUES = ['PlaceModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PlaceModel'];
    public const TYPES = ['ExerciseAction' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ExerciseActionModel', 'MoveAction' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MoveActionModel', 'TransferAction' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TransferActionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
