<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class IsbnModel
{
    public const DESCRIPTION = 'The ISBN of the book.';
    public const LABEL = 'isbn';
    public const NAME = 'schema:isbn';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Book' => 'Jolicode\Vocabularies\SchemaOrg\Type\BookModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
