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

final class BookFormatModel
{
    public const DESCRIPTION = 'The format of the book.';
    public const LABEL = 'bookFormat';
    public const NAME = 'schema:bookFormat';
    public const VALUES = ['BookFormatTypeModel' => 'SchemaOrg\Type\BookFormatTypeModel'];
    public const TYPES = ['Book' => 'SchemaOrg\Type\BookModel'];
}
