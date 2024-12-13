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

final class PrintPageModel
{
    public const DESCRIPTION = 'If this NewsArticle appears in print, this field indicates the name of the page on which the article is found. Please note that this field is intended for the exact page name (e.g. A5, B18).';
    public const LABEL = 'printPage';
    public const NAME = 'schema:printPage';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['NewsArticle' => 'Jolicode\SchemaOrg\Type\NewsArticleModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
