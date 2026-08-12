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

final class GameAvailabilityTypeModel
{
    public const DESCRIPTION = 'Indicates the availability type of the game content associated with this action, such as whether it is a full version or a demo.';
    public const LABEL = 'gameAvailabilityType';
    public const NAME = 'schema:gameAvailabilityType';
    public const VALUES = ['GameAvailabilityEnumerationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\GameAvailabilityEnumerationModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['PlayGameAction' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PlayGameActionModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/3058'];
    public const SUPERSEDED_BY = null;
}
