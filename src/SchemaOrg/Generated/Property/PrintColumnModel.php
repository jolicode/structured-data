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

final class PrintColumnModel
{
    public const DESCRIPTION = 'The number of the column in which the NewsArticle appears in the print edition.';
    public const LABEL = 'printColumn';
    public const NAME = 'schema:printColumn';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['NewsArticle' => 'Jolicode\SchemaOrg\Type\NewsArticleModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
