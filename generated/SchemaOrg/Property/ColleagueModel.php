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

final class ColleagueModel
{
    public const DESCRIPTION = 'A colleague of the person.';
    public const LABEL = 'colleague';
    public const NAME = 'schema:colleague';
    public const VALUES = ['PersonModel' => 'SchemaOrg\\Type\\PersonModel', 'URLModel' => 'SchemaOrg\\Type\\URLModel'];
    public const TYPES = ['Person' => 'SchemaOrg\\Type\\PersonModel'];
}
