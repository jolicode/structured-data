<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class ArticleBodyModel
{
    public const DESCRIPTION = 'The actual body of the article.';
    public const LABEL = 'articleBody';
    public const NAME = 'schema:articleBody';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['Article' => 'SchemaOrg\\Type\\ArticleModel'];
}
