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

final class EventsModel
{
    public const DESCRIPTION = 'Upcoming or past events associated with this place or organization.';
    public const LABEL = 'events';
    public const NAME = 'schema:events';
    public const VALUES = ['EventModel' => 'Jolicode\SchemaOrg\Type\EventModel'];
    public const TYPES = ['Organization' => 'Jolicode\SchemaOrg\Type\OrganizationModel', 'Place' => 'Jolicode\SchemaOrg\Type\PlaceModel'];
}
