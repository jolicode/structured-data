<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class SeatingTypeModel
{
    public const DESCRIPTION = 'The type/class of the seat.';
    public const LABEL = 'seatingType';
    public const NAME = 'schema:seatingType';
    public const VALUES = ['QualitativeValueModel' => 'Jolicode\SchemaOrg\Type\QualitativeValueModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Seat' => 'Jolicode\SchemaOrg\Type\SeatModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
