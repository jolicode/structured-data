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

final class ThumbnailModel
{
    public const DESCRIPTION = 'Thumbnail image for an image or video.';
    public const LABEL = 'thumbnail';
    public const NAME = 'schema:thumbnail';
    public const VALUES = ['ImageObjectModel' => 'SchemaOrg\\Type\\ImageObjectModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\\Type\\CreativeWorkModel'];
}
