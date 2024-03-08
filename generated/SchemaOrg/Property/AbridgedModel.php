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

final class AbridgedModel
{
    public const DESCRIPTION = 'Indicates whether the book is an abridged edition.';
    public const LABEL = 'abridged';
    public const NAME = 'schema:abridged';
    public const VALUES = ['BooleanModel' => 'SchemaOrg\\Type\\BooleanModel'];
    public const TYPES = ['Book' => 'SchemaOrg\\Type\\BookModel'];
}
