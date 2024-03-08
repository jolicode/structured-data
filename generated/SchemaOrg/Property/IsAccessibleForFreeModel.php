<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class IsAccessibleForFreeModel
{
    public const DESCRIPTION = 'A flag to signal that the item, event, or place is accessible for free.';
    public const LABEL = 'isAccessibleForFree';
    public const NAME = 'schema:isAccessibleForFree';
    public const VALUES = ['BooleanModel' => 'SchemaOrg\Type\BooleanModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\Type\CreativeWorkModel', 'Event' => 'SchemaOrg\Type\EventModel', 'Place' => 'SchemaOrg\Type\PlaceModel'];
}
