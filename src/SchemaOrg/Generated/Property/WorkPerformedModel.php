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

final class WorkPerformedModel
{
    public const DESCRIPTION = 'A work performed in some event, for example a play performed in a TheaterEvent.';
    public const LABEL = 'workPerformed';
    public const NAME = 'schema:workPerformed';
    public const VALUES = ['CreativeWorkModel' => 'Jolicode\SchemaOrg\Type\CreativeWorkModel'];
    public const TYPES = ['Event' => 'Jolicode\SchemaOrg\Type\EventModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
