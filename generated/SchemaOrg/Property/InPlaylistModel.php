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

final class InPlaylistModel
{
    public const DESCRIPTION = 'The playlist to which this recording belongs.';
    public const LABEL = 'inPlaylist';
    public const NAME = 'schema:inPlaylist';
    public const VALUES = ['MusicPlaylistModel' => 'SchemaOrg\\Type\\MusicPlaylistModel'];
    public const TYPES = ['MusicRecording' => 'SchemaOrg\\Type\\MusicRecordingModel'];
}
