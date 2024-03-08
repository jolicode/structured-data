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

final class OrganizerModel
{
    public const DESCRIPTION = 'An organizer of an Event.';
    public const LABEL = 'organizer';
    public const NAME = 'schema:organizer';
    public const VALUES = ['OrganizationModel' => 'SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Event' => 'SchemaOrg\Type\EventModel'];
}
