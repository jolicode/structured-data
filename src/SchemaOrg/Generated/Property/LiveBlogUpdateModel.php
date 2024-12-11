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

final class LiveBlogUpdateModel
{
    public const DESCRIPTION = 'An update to the LiveBlog.';
    public const LABEL = 'liveBlogUpdate';
    public const NAME = 'schema:liveBlogUpdate';
    public const VALUES = ['BlogPostingModel' => 'Jolicode\SchemaOrg\Type\BlogPostingModel'];
    public const TYPES = ['LiveBlogPosting' => 'Jolicode\SchemaOrg\Type\LiveBlogPostingModel'];
}
