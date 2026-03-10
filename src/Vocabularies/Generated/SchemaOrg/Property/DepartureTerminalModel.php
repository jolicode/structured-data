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

final class DepartureTerminalModel
{
    public const DESCRIPTION = 'Identifier of the flight\'s departure terminal.';
    public const LABEL = 'departureTerminal';
    public const NAME = 'schema:departureTerminal';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Flight' => 'Jolicode\Vocabularies\SchemaOrg\Type\FlightModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
