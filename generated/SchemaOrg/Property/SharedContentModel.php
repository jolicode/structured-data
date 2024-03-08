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

final class SharedContentModel
{
    public const DESCRIPTION = 'A CreativeWork such as an image, video, or audio clip shared as part of this posting.';
    public const LABEL = 'sharedContent';
    public const NAME = 'schema:sharedContent';
    public const VALUES = ['CreativeWorkModel' => 'SchemaOrg\\Type\\CreativeWorkModel'];
    public const TYPES = ['SocialMediaPosting' => 'SchemaOrg\\Type\\SocialMediaPostingModel'];
}
