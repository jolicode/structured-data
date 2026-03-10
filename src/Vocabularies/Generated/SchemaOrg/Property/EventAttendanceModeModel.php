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

final class EventAttendanceModeModel
{
    public const DESCRIPTION = 'The eventAttendanceMode of an event indicates whether it occurs online, offline, or a mix.';
    public const LABEL = 'eventAttendanceMode';
    public const NAME = 'schema:eventAttendanceMode';
    public const VALUES = ['EventAttendanceModeEnumerationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\EventAttendanceModeEnumerationModel'];
    public const TYPES = ['Event' => 'Jolicode\Vocabularies\SchemaOrg\Type\EventModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
