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

final class MaximumPhysicalAttendeeCapacityModel
{
    public const DESCRIPTION = 'The maximum physical attendee capacity of an [[Event]] whose [[eventAttendanceMode]] is [[OfflineEventAttendanceMode]] (or the offline aspects, in the case of a [[MixedEventAttendanceMode]]).';
    public const LABEL = 'maximumPhysicalAttendeeCapacity';
    public const NAME = 'schema:maximumPhysicalAttendeeCapacity';
    public const VALUES = ['IntegerModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\IntegerModel'];
    public const TYPES = ['Event' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\EventModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1842'];
    public const SUPERSEDED_BY = null;
}
