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

final class FoundingDateModel
{
    public const DESCRIPTION = 'The date that this organization was founded.';
    public const LABEL = 'foundingDate';
    public const NAME = 'schema:foundingDate';
    public const VALUES = ['DateModel' => 'SchemaOrg\Type\DateModel'];
    public const TYPES = ['Organization' => 'SchemaOrg\Type\OrganizationModel'];
}
