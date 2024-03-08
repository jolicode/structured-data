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

final class NoBylinesPolicyModel
{
    public const DESCRIPTION = 'For a [[NewsMediaOrganization]] or other news-related [[Organization]], a statement explaining when authors of articles are not named in bylines.';
    public const LABEL = 'noBylinesPolicy';
    public const NAME = 'schema:noBylinesPolicy';
    public const VALUES = ['CreativeWorkModel' => 'SchemaOrg\Type\CreativeWorkModel', 'URLModel' => 'SchemaOrg\Type\URLModel'];
    public const TYPES = ['NewsMediaOrganization' => 'SchemaOrg\Type\NewsMediaOrganizationModel'];
}
