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

final class BookEditionModel
{
    public const DESCRIPTION = 'The edition of the book.';
    public const LABEL = 'bookEdition';
    public const NAME = 'schema:bookEdition';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['Book' => 'SchemaOrg\Type\BookModel'];
}
