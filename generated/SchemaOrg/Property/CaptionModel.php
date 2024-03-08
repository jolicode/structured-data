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

final class CaptionModel
{
    public const DESCRIPTION = 'The caption for this object. For downloadable machine formats (closed caption, subtitles etc.) use MediaObject and indicate the [[encodingFormat]].';
    public const LABEL = 'caption';
    public const NAME = 'schema:caption';
    public const VALUES = ['MediaObjectModel' => 'SchemaOrg\\Type\\MediaObjectModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['AudioObject' => 'SchemaOrg\\Type\\AudioObjectModel', 'ImageObject' => 'SchemaOrg\\Type\\ImageObjectModel', 'VideoObject' => 'SchemaOrg\\Type\\VideoObjectModel'];
}
