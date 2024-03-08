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

final class TranscriptModel
{
    public const DESCRIPTION = 'If this MediaObject is an AudioObject or VideoObject, the transcript of that object.';
    public const LABEL = 'transcript';
    public const NAME = 'schema:transcript';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['AudioObject' => 'SchemaOrg\Type\AudioObjectModel', 'VideoObject' => 'SchemaOrg\Type\VideoObjectModel'];
}
