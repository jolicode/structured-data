<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class WordCountModel
{
    public const DESCRIPTION = 'The number of words in the text of the CreativeWork such as an Article, Book, etc.';
    public const LABEL = 'wordCount';
    public const NAME = 'schema:wordCount';
    public const VALUES = ['IntegerModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\IntegerModel'];
    public const TYPES = ['Article' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ArticleModel', 'CreativeWork' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
