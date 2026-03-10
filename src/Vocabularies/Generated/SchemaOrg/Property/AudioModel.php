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

final class AudioModel
{
    public const DESCRIPTION = 'An embedded audio object.';
    public const LABEL = 'audio';
    public const NAME = 'schema:audio';
    public const VALUES = ['AudioObjectModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\AudioObjectModel', 'ClipModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\ClipModel', 'MusicRecordingModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MusicRecordingModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\Vocabularies\SchemaOrg\Type\CreativeWorkModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
