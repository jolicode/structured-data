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

final class EndTimeModel
{
    public const DESCRIPTION = 'The endTime of something. For a reserved event or service (e.g. FoodEstablishmentReservation), the time that it is expected to end. For actions that span a period of time, when the action was performed. E.g. John wrote a book from January to *December*. For media, including audio and video, it\'s the time offset of the end of a clip within a larger file.\n\nNote that Event uses startDate/endDate instead of startTime/endTime, even when describing dates with times. This situation may be clarified in future revisions.';
    public const LABEL = 'endTime';
    public const NAME = 'schema:endTime';
    public const VALUES = ['DateTimeModel' => 'Jolicode\SchemaOrg\Type\DateTimeModel', 'TimeModel' => 'Jolicode\SchemaOrg\Type\TimeModel'];
    public const TYPES = ['Action' => 'Jolicode\SchemaOrg\Type\ActionModel', 'FoodEstablishmentReservation' => 'Jolicode\SchemaOrg\Type\FoodEstablishmentReservationModel', 'InteractionCounter' => 'Jolicode\SchemaOrg\Type\InteractionCounterModel', 'MediaObject' => 'Jolicode\SchemaOrg\Type\MediaObjectModel', 'Schedule' => 'Jolicode\SchemaOrg\Type\ScheduleModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
