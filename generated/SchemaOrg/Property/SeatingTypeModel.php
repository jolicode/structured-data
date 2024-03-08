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

final class SeatingTypeModel
{
    public const DESCRIPTION = 'The type/class of the seat.';
    public const LABEL = 'seatingType';
    public const NAME = 'schema:seatingType';
    public const VALUES = ['QualitativeValueModel' => 'SchemaOrg\\Type\\QualitativeValueModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['Seat' => 'SchemaOrg\\Type\\SeatModel'];
}
