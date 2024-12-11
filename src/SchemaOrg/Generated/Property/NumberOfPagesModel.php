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

final class NumberOfPagesModel
{
    public const DESCRIPTION = 'The number of pages in the book.';
    public const LABEL = 'numberOfPages';
    public const NAME = 'schema:numberOfPages';
    public const VALUES = ['IntegerModel' => 'Jolicode\SchemaOrg\Type\IntegerModel'];
    public const TYPES = ['Book' => 'Jolicode\SchemaOrg\Type\BookModel'];
}
