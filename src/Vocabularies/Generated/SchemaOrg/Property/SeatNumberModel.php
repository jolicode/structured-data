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

final class SeatNumberModel
{
    public const DESCRIPTION = 'The location of the reserved seat (e.g., 27).';
    public const LABEL = 'seatNumber';
    public const NAME = 'schema:seatNumber';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Seat' => 'Jolicode\Vocabularies\SchemaOrg\Type\SeatModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
