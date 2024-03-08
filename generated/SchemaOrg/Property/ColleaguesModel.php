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

final class ColleaguesModel
{
    public const DESCRIPTION = 'A colleague of the person.';
    public const LABEL = 'colleagues';
    public const NAME = 'schema:colleagues';
    public const VALUES = ['PersonModel' => 'SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Person' => 'SchemaOrg\Type\PersonModel'];
}
