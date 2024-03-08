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

final class BackstoryModel
{
    public const DESCRIPTION = 'For an [[Article]], typically a [[NewsArticle]], the backstory property provides a textual summary giving a brief explanation of why and how an article was created. In a journalistic setting this could include information about reporting process, methods, interviews, data sources, etc.';
    public const LABEL = 'backstory';
    public const NAME = 'schema:backstory';
    public const VALUES = ['CreativeWorkModel' => 'SchemaOrg\Type\CreativeWorkModel', 'TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['Article' => 'SchemaOrg\Type\ArticleModel'];
}
