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

final class BroadcastOfEventModel
{
    public const DESCRIPTION = 'The event being broadcast such as a sporting event or awards ceremony.';
    public const LABEL = 'broadcastOfEvent';
    public const NAME = 'schema:broadcastOfEvent';
    public const VALUES = ['EventModel' => 'SchemaOrg\\Type\\EventModel'];
    public const TYPES = ['BroadcastEvent' => 'SchemaOrg\\Type\\BroadcastEventModel'];
}
