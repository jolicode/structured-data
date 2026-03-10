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

final class EmbeddedTextCaptionModel
{
    public const DESCRIPTION = 'Represents textual captioning from a [[MediaObject]], e.g. text of a \'meme\'.';
    public const LABEL = 'embeddedTextCaption';
    public const NAME = 'schema:embeddedTextCaption';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['AudioObject' => 'Jolicode\Vocabularies\SchemaOrg\Type\AudioObjectModel', 'ImageObject' => 'Jolicode\Vocabularies\SchemaOrg\Type\ImageObjectModel', 'VideoObject' => 'Jolicode\Vocabularies\SchemaOrg\Type\VideoObjectModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
