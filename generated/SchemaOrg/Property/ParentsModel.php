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

final class ParentsModel
{
    public const DESCRIPTION = 'A parents of the person.';
    public const LABEL = 'parents';
    public const NAME = 'schema:parents';
    public const VALUES = ['PersonModel' => 'SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Person' => 'SchemaOrg\Type\PersonModel'];
}
