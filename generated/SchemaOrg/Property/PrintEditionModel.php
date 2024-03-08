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

final class PrintEditionModel
{
    public const DESCRIPTION = 'The edition of the print product in which the NewsArticle appears.';
    public const LABEL = 'printEdition';
    public const NAME = 'schema:printEdition';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['NewsArticle' => 'SchemaOrg\Type\NewsArticleModel'];
}
