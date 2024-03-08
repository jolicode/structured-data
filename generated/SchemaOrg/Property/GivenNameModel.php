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

final class GivenNameModel
{
    public const DESCRIPTION = 'Given name. In the U.S., the first name of a Person.';
    public const LABEL = 'givenName';
    public const NAME = 'schema:givenName';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['Person' => 'SchemaOrg\Type\PersonModel'];
}
