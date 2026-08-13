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

final class DepartureBoatTerminalModel
{
    public const DESCRIPTION = 'The terminal or port from which the boat departs.';
    public const LABEL = 'departureBoatTerminal';
    public const NAME = 'schema:departureBoatTerminal';
    public const VALUES = ['BoatTerminalModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\BoatTerminalModel'];
    public const TYPES = ['BoatTrip' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\BoatTripModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1755'];
    public const SUPERSEDED_BY = null;
}
