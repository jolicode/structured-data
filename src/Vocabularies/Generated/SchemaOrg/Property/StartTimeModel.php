<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class StartTimeModel
{
    public const DESCRIPTION = 'The startTime of something. For a reserved event or service (e.g. FoodEstablishmentReservation), the time that it is expected to start. For actions that span a period of time, when the action was performed. E.g. John wrote a book from *January* to December. For media, including audio and video, it\'s the time offset of the start of a clip within a larger file.\n\nNote that Event uses startDate/endDate instead of startTime/endTime, even when describing dates with times. This situation may be clarified in future revisions.';
    public const LABEL = 'startTime';
    public const NAME = 'schema:startTime';
    public const VALUES = ['DateTimeModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DateTimeModel', 'TimeModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TimeModel'];
    public const TYPES = ['Action' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ActionModel', 'FoodEstablishmentReservation' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\FoodEstablishmentReservationModel', 'InteractionCounter' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\InteractionCounterModel', 'MediaObject' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MediaObjectModel', 'Schedule' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ScheduleModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
