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

final class InPlaylistModel
{
    public const DESCRIPTION = 'The playlist to which this recording belongs.';
    public const LABEL = 'inPlaylist';
    public const NAME = 'schema:inPlaylist';
    public const VALUES = ['MusicPlaylistModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MusicPlaylistModel'];
    public const TYPES = ['MusicRecording' => 'Jolicode\Vocabularies\SchemaOrg\Type\MusicRecordingModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
