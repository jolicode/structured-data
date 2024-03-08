<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class SeatRowModel
{
    public const DESCRIPTION = 'The row location of the reserved seat (e.g., B).';
    public const LABEL = 'seatRow';
    public const NAME = 'schema:seatRow';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['Seat' => 'SchemaOrg\\Type\\SeatModel'];
}
