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

final class SubEventsModel
{
    public const DESCRIPTION = 'Events that are a part of this event. For example, a conference event includes many presentations, each subEvents of the conference.';
    public const LABEL = 'subEvents';
    public const NAME = 'schema:subEvents';
    public const VALUES = ['EventModel' => 'SchemaOrg\\Type\\EventModel'];
    public const TYPES = ['Event' => 'SchemaOrg\\Type\\EventModel'];
}
