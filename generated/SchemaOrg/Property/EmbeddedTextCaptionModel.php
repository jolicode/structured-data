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

final class EmbeddedTextCaptionModel
{
    public const DESCRIPTION = 'Represents textual captioning from a [[MediaObject]], e.g. text of a \'meme\'.';
    public const LABEL = 'embeddedTextCaption';
    public const NAME = 'schema:embeddedTextCaption';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['AudioObject' => 'SchemaOrg\\Type\\AudioObjectModel', 'ImageObject' => 'SchemaOrg\\Type\\ImageObjectModel', 'VideoObject' => 'SchemaOrg\\Type\\VideoObjectModel'];
}
