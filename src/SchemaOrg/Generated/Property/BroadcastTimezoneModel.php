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

final class BroadcastTimezoneModel
{
    public const DESCRIPTION = 'The timezone in [ISO 8601 format](http://en.wikipedia.org/wiki/ISO_8601) for which the service bases its broadcasts.';
    public const LABEL = 'broadcastTimezone';
    public const NAME = 'schema:broadcastTimezone';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['BroadcastService' => 'Jolicode\SchemaOrg\Type\BroadcastServiceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
