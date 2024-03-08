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

final class StartTimeModel
{
    public const DESCRIPTION = 'The startTime of something. For a reserved event or service (e.g. FoodEstablishmentReservation), the time that it is expected to start. For actions that span a period of time, when the action was performed. E.g. John wrote a book from *January* to December. For media, including audio and video, it\'s the time offset of the start of a clip within a larger file.\\n\\nNote that Event uses startDate/endDate instead of startTime/endTime, even when describing dates with times. This situation may be clarified in future revisions.';
    public const LABEL = 'startTime';
    public const NAME = 'schema:startTime';
    public const VALUES = ['DateTimeModel' => 'SchemaOrg\\Type\\DateTimeModel', 'TimeModel' => 'SchemaOrg\\Type\\TimeModel'];
    public const TYPES = ['Action' => 'SchemaOrg\\Type\\ActionModel', 'FoodEstablishmentReservation' => 'SchemaOrg\\Type\\FoodEstablishmentReservationModel', 'InteractionCounter' => 'SchemaOrg\\Type\\InteractionCounterModel', 'MediaObject' => 'SchemaOrg\\Type\\MediaObjectModel', 'Schedule' => 'SchemaOrg\\Type\\ScheduleModel'];
}
