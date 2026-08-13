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

final class CallSignModel
{
    public const DESCRIPTION = 'A [callsign](https://en.wikipedia.org/wiki/Call_sign), as used in broadcasting and radio communications to identify people, radio and TV stations, or vehicles.';
    public const LABEL = 'callSign';
    public const NAME = 'schema:callSign';
    public const VALUES = ['TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['BroadcastService' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\BroadcastServiceModel', 'Person' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PersonModel', 'Vehicle' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\VehicleModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2109'];
    public const SUPERSEDED_BY = null;
}
