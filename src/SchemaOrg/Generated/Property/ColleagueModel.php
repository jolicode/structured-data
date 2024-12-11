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

final class ColleagueModel
{
    public const DESCRIPTION = 'A colleague of the person.';
    public const LABEL = 'colleague';
    public const NAME = 'schema:colleague';
    public const VALUES = ['PersonModel' => 'Jolicode\SchemaOrg\Type\PersonModel', 'URLModel' => 'Jolicode\SchemaOrg\Type\URLModel'];
    public const TYPES = ['Person' => 'Jolicode\SchemaOrg\Type\PersonModel'];
}
