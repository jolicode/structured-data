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

final class DropoffTimeModel
{
    public const DESCRIPTION = 'When a rental car can be dropped off.';
    public const LABEL = 'dropoffTime';
    public const NAME = 'schema:dropoffTime';
    public const VALUES = ['DateTimeModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['RentalCarReservation' => 'Jolicode\Vocabularies\SchemaOrg\Type\RentalCarReservationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
