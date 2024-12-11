<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class TracksModel
{
    public const DESCRIPTION = 'A music recording (track)&#x2014;usually a single song.';
    public const LABEL = 'tracks';
    public const NAME = 'schema:tracks';
    public const VALUES = ['MusicRecordingModel' => 'Jolicode\SchemaOrg\Type\MusicRecordingModel'];
    public const TYPES = ['MusicGroup' => 'Jolicode\SchemaOrg\Type\MusicGroupModel', 'MusicPlaylist' => 'Jolicode\SchemaOrg\Type\MusicPlaylistModel'];
}
