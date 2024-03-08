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

final class CheckinTimeModel
{
    public const DESCRIPTION = 'The earliest someone may check into a lodging establishment.';
    public const LABEL = 'checkinTime';
    public const NAME = 'schema:checkinTime';
    public const VALUES = ['DateTimeModel' => 'SchemaOrg\\Type\\DateTimeModel', 'TimeModel' => 'SchemaOrg\\Type\\TimeModel'];
    public const TYPES = ['LodgingBusiness' => 'SchemaOrg\\Type\\LodgingBusinessModel', 'LodgingReservation' => 'SchemaOrg\\Type\\LodgingReservationModel'];
}
