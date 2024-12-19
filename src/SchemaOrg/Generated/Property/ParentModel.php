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

final class ParentModel
{
    public const DESCRIPTION = 'A parent of this person.';
    public const LABEL = 'parent';
    public const NAME = 'schema:parent';
    public const VALUES = ['PersonModel' => 'Jolicode\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Person' => 'Jolicode\SchemaOrg\Type\PersonModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
