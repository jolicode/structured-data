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

final class CheckinTimeModel
{
    public const DESCRIPTION = 'The earliest someone may check into a lodging establishment.';
    public const LABEL = 'checkinTime';
    public const NAME = 'schema:checkinTime';
    public const VALUES = ['DateTimeModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DateTimeModel', 'TimeModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TimeModel'];
    public const TYPES = ['LodgingBusiness' => 'Jolicode\Vocabularies\SchemaOrg\Type\LodgingBusinessModel', 'LodgingReservation' => 'Jolicode\Vocabularies\SchemaOrg\Type\LodgingReservationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
