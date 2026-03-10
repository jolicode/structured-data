<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class SharedContentModel
{
    public const DESCRIPTION = 'A CreativeWork such as an image, video, or audio clip shared as part of this posting.';
    public const LABEL = 'sharedContent';
    public const NAME = 'schema:sharedContent';
    public const VALUES = ['CreativeWorkModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\CreativeWorkModel'];
    public const TYPES = ['Comment' => 'Jolicode\Vocabularies\SchemaOrg\Type\CommentModel', 'SocialMediaPosting' => 'Jolicode\Vocabularies\SchemaOrg\Type\SocialMediaPostingModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
