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

final class InAlbumModel
{
    public const DESCRIPTION = 'The album to which this recording belongs.';
    public const LABEL = 'inAlbum';
    public const NAME = 'schema:inAlbum';
    public const VALUES = ['MusicAlbumModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MusicAlbumModel'];
    public const TYPES = ['MusicRecording' => 'Jolicode\Vocabularies\SchemaOrg\Type\MusicRecordingModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
