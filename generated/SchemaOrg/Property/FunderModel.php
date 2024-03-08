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

final class FunderModel
{
    public const DESCRIPTION = 'A person or organization that supports (sponsors) something through some kind of financial contribution.';
    public const LABEL = 'funder';
    public const NAME = 'schema:funder';
    public const VALUES = ['OrganizationModel' => 'SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'SchemaOrg\Type\PersonModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\Type\CreativeWorkModel', 'Event' => 'SchemaOrg\Type\EventModel', 'Grant' => 'SchemaOrg\Type\GrantModel', 'MonetaryGrant' => 'SchemaOrg\Type\MonetaryGrantModel', 'Organization' => 'SchemaOrg\Type\OrganizationModel', 'Person' => 'SchemaOrg\Type\PersonModel'];
}
