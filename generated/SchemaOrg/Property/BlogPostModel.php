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

final class BlogPostModel
{
    public const DESCRIPTION = 'A posting that is part of this blog.';
    public const LABEL = 'blogPost';
    public const NAME = 'schema:blogPost';
    public const VALUES = ['BlogPostingModel' => 'SchemaOrg\Type\BlogPostingModel'];
    public const TYPES = ['Blog' => 'SchemaOrg\Type\BlogModel'];
}
