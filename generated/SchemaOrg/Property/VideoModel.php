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

final class VideoModel
{
    public const DESCRIPTION = 'An embedded video object.';
    public const LABEL = 'video';
    public const NAME = 'schema:video';
    public const VALUES = ['ClipModel' => 'SchemaOrg\Type\ClipModel', 'VideoObjectModel' => 'SchemaOrg\Type\VideoObjectModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\Type\CreativeWorkModel'];
}
