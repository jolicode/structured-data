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

final class PublishedByModel
{
    public const DESCRIPTION = 'An agent associated with the publication event.';
    public const LABEL = 'publishedBy';
    public const NAME = 'schema:publishedBy';
    public const VALUES = ['OrganizationModel' => 'SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'SchemaOrg\Type\PersonModel'];
    public const TYPES = ['PublicationEvent' => 'SchemaOrg\Type\PublicationEventModel'];
}
