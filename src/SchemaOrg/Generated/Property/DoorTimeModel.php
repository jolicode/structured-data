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

final class DoorTimeModel
{
    public const DESCRIPTION = 'The time admission will commence.';
    public const LABEL = 'doorTime';
    public const NAME = 'schema:doorTime';
    public const VALUES = ['DateTimeModel' => 'Jolicode\SchemaOrg\Type\DateTimeModel', 'TimeModel' => 'Jolicode\SchemaOrg\Type\TimeModel'];
    public const TYPES = ['Event' => 'Jolicode\SchemaOrg\Type\EventModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
