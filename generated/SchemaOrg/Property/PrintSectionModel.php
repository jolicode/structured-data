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

final class PrintSectionModel
{
    public const DESCRIPTION = 'If this NewsArticle appears in print, this field indicates the print section in which the article appeared.';
    public const LABEL = 'printSection';
    public const NAME = 'schema:printSection';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['NewsArticle' => 'SchemaOrg\Type\NewsArticleModel'];
}
