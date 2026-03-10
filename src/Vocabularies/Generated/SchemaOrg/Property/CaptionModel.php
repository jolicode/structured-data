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

final class CaptionModel
{
    public const DESCRIPTION = 'The caption for this object. For downloadable machine formats (closed caption, subtitles etc.) use MediaObject and indicate the [[encodingFormat]].';
    public const LABEL = 'caption';
    public const NAME = 'schema:caption';
    public const VALUES = ['MediaObjectModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MediaObjectModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['AudioObject' => 'Jolicode\Vocabularies\SchemaOrg\Type\AudioObjectModel', 'ImageObject' => 'Jolicode\Vocabularies\SchemaOrg\Type\ImageObjectModel', 'VideoObject' => 'Jolicode\Vocabularies\SchemaOrg\Type\VideoObjectModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
