<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class FoundingLocationModel
{
    public const DESCRIPTION = 'The place where the Organization was founded.';
    public const LABEL = 'foundingLocation';
    public const NAME = 'schema:foundingLocation';
    public const VALUES = ['PlaceModel' => 'SchemaOrg\\Type\\PlaceModel'];
    public const TYPES = ['Organization' => 'SchemaOrg\\Type\\OrganizationModel'];
}
