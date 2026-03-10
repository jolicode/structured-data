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

final class IllustratorModel
{
    public const DESCRIPTION = 'The illustrator of the book.';
    public const LABEL = 'illustrator';
    public const NAME = 'schema:illustrator';
    public const VALUES = ['PersonModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Book' => 'Jolicode\Vocabularies\SchemaOrg\Type\BookModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
