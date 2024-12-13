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

final class DunsModel
{
    public const DESCRIPTION = 'The Dun & Bradstreet DUNS number for identifying an organization or business person.';
    public const LABEL = 'duns';
    public const NAME = 'schema:duns';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Organization' => 'Jolicode\SchemaOrg\Type\OrganizationModel', 'Person' => 'Jolicode\SchemaOrg\Type\PersonModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
