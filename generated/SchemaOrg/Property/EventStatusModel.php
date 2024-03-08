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

final class EventStatusModel
{
    public const DESCRIPTION = 'An eventStatus of an event represents its status; particularly useful when an event is cancelled or rescheduled.';
    public const LABEL = 'eventStatus';
    public const NAME = 'schema:eventStatus';
    public const VALUES = ['EventStatusTypeModel' => 'SchemaOrg\\Type\\EventStatusTypeModel'];
    public const TYPES = ['Event' => 'SchemaOrg\\Type\\EventModel'];
}
