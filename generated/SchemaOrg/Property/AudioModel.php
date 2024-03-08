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

final class AudioModel
{
    public const DESCRIPTION = 'An embedded audio object.';
    public const LABEL = 'audio';
    public const NAME = 'schema:audio';
    public const VALUES = ['AudioObjectModel' => 'SchemaOrg\\Type\\AudioObjectModel', 'ClipModel' => 'SchemaOrg\\Type\\ClipModel', 'MusicRecordingModel' => 'SchemaOrg\\Type\\MusicRecordingModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\\Type\\CreativeWorkModel'];
}
