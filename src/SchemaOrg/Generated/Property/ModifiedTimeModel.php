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

final class ModifiedTimeModel
{
    public const DESCRIPTION = 'The date and time the reservation was modified.';
    public const LABEL = 'modifiedTime';
    public const NAME = 'schema:modifiedTime';
    public const VALUES = ['DateTimeModel' => 'Jolicode\SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['Reservation' => 'Jolicode\SchemaOrg\Type\ReservationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
