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

final class AssociatedArticleModel
{
    public const DESCRIPTION = 'A NewsArticle associated with the Media Object.';
    public const LABEL = 'associatedArticle';
    public const NAME = 'schema:associatedArticle';
    public const VALUES = ['NewsArticleModel' => 'Jolicode\SchemaOrg\Type\NewsArticleModel'];
    public const TYPES = ['MediaObject' => 'Jolicode\SchemaOrg\Type\MediaObjectModel'];
}
