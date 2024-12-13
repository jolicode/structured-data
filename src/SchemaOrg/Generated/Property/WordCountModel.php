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

final class WordCountModel
{
    public const DESCRIPTION = 'The number of words in the text of the Article.';
    public const LABEL = 'wordCount';
    public const NAME = 'schema:wordCount';
    public const VALUES = ['IntegerModel' => 'Jolicode\SchemaOrg\Type\IntegerModel'];
    public const TYPES = ['Article' => 'Jolicode\SchemaOrg\Type\ArticleModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
