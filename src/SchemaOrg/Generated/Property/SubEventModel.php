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

final class SubEventModel
{
    public const DESCRIPTION = 'An Event that is part of this event. For example, a conference event includes many presentations, each of which is a subEvent of the conference.';
    public const LABEL = 'subEvent';
    public const NAME = 'schema:subEvent';
    public const VALUES = ['EventModel' => 'Jolicode\SchemaOrg\Type\EventModel'];
    public const TYPES = ['Event' => 'Jolicode\SchemaOrg\Type\EventModel'];
}
