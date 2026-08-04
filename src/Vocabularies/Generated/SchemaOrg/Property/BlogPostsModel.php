<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class BlogPostsModel
{
    public const DESCRIPTION = 'Indicates a post that is part of a [[Blog]]. Note that historically, what we term a "Blog" was once known as a "weblog", and that what we term a "BlogPosting" is now often colloquially referred to as a "blog".';
    public const LABEL = 'blogPosts';
    public const NAME = 'schema:blogPosts';
    public const VALUES = ['BlogPostingModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\BlogPostingModel'];
    public const TYPES = ['Blog' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\BlogModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = 'blogPost';
}
