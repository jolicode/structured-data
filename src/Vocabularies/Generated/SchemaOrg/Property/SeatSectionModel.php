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

final class SeatSectionModel
{
    public const DESCRIPTION = 'The section location of the reserved seat (e.g. Orchestra).';
    public const LABEL = 'seatSection';
    public const NAME = 'schema:seatSection';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Seat' => 'Jolicode\Vocabularies\SchemaOrg\Type\SeatModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
