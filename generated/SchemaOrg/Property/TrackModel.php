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

final class TrackModel
{
    public const DESCRIPTION = 'A music recording (track)&#x2014;usually a single song. If an ItemList is given, the list should contain items of type MusicRecording.';
    public const LABEL = 'track';
    public const NAME = 'schema:track';
    public const VALUES = ['ItemListModel' => 'SchemaOrg\\Type\\ItemListModel', 'MusicRecordingModel' => 'SchemaOrg\\Type\\MusicRecordingModel'];
    public const TYPES = ['MusicGroup' => 'SchemaOrg\\Type\\MusicGroupModel', 'MusicPlaylist' => 'SchemaOrg\\Type\\MusicPlaylistModel'];
}
