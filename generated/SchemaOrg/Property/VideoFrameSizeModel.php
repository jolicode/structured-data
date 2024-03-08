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

final class VideoFrameSizeModel
{
    public const DESCRIPTION = 'The frame size of the video.';
    public const LABEL = 'videoFrameSize';
    public const NAME = 'schema:videoFrameSize';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['VideoObject' => 'SchemaOrg\Type\VideoObjectModel'];
}
