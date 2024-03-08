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

final class ChildrenModel
{
    public const DESCRIPTION = 'A child of the person.';
    public const LABEL = 'children';
    public const NAME = 'schema:children';
    public const VALUES = ['PersonModel' => 'SchemaOrg\\Type\\PersonModel'];
    public const TYPES = ['Person' => 'SchemaOrg\\Type\\PersonModel'];
}
