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

final class EventStatusModel
{
    public const DESCRIPTION = 'An eventStatus of an event represents its status; particularly useful when an event is cancelled or rescheduled.';
    public const LABEL = 'eventStatus';
    public const NAME = 'schema:eventStatus';
    public const VALUES = ['EventStatusTypeModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\EventStatusTypeModel'];
    public const TYPES = ['Event' => 'Jolicode\Vocabularies\SchemaOrg\Type\EventModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
