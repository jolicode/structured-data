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

final class PublisherImprintModel
{
    public const DESCRIPTION = 'The publishing division which published the comic.';
    public const LABEL = 'publisherImprint';
    public const NAME = 'schema:publisherImprint';
    public const VALUES = ['OrganizationModel' => 'SchemaOrg\Type\OrganizationModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\Type\CreativeWorkModel'];
}
