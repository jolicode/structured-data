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

final class CaptionModel
{
    public const DESCRIPTION = 'The caption for this object. For downloadable machine formats (closed caption, subtitles etc.) use MediaObject and indicate the [[encodingFormat]].';
    public const LABEL = 'caption';
    public const NAME = 'schema:caption';
    public const VALUES = ['MediaObjectModel' => 'Jolicode\SchemaOrg\Type\MediaObjectModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['AudioObject' => 'Jolicode\SchemaOrg\Type\AudioObjectModel', 'ImageObject' => 'Jolicode\SchemaOrg\Type\ImageObjectModel', 'VideoObject' => 'Jolicode\SchemaOrg\Type\VideoObjectModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
