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

final class VideoModel
{
    public const DESCRIPTION = 'An embedded video object.';
    public const LABEL = 'video';
    public const NAME = 'schema:video';
    public const VALUES = ['ClipModel' => 'Jolicode\SchemaOrg\Type\ClipModel', 'VideoObjectModel' => 'Jolicode\SchemaOrg\Type\VideoObjectModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\SchemaOrg\Type\CreativeWorkModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
