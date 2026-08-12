<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class CaptionModel
{
    public const DESCRIPTION = 'The caption for this object. For downloadable machine formats (closed caption, subtitles etc.) use MediaObject and indicate the [[encodingFormat]].';
    public const LABEL = 'caption';
    public const NAME = 'schema:caption';
    public const VALUES = ['MediaObjectModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MediaObjectModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['AudioObject' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\AudioObjectModel', 'ImageObject' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ImageObjectModel', 'VideoObject' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\VideoObjectModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
