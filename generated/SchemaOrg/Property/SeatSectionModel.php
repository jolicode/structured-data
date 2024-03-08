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

final class SeatSectionModel
{
    public const DESCRIPTION = 'The section location of the reserved seat (e.g. Orchestra).';
    public const LABEL = 'seatSection';
    public const NAME = 'schema:seatSection';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['Seat' => 'SchemaOrg\Type\SeatModel'];
}
