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

final class GameAvailabilityTypeModel
{
    public const DESCRIPTION = 'Indicates the availability type of the game content associated with this action, such as whether it is a full version or a demo.';
    public const LABEL = 'gameAvailabilityType';
    public const NAME = 'schema:gameAvailabilityType';
    public const VALUES = ['GameAvailabilityEnumerationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\GameAvailabilityEnumerationModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['PlayGameAction' => 'Jolicode\Vocabularies\SchemaOrg\Type\PlayGameActionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
