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

final class TracksModel
{
    public const DESCRIPTION = 'A music recording (track)&#x2014;usually a single song.';
    public const LABEL = 'tracks';
    public const NAME = 'schema:tracks';
    public const VALUES = ['MusicRecordingModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MusicRecordingModel'];
    public const TYPES = ['MusicGroup' => 'Jolicode\Vocabularies\SchemaOrg\Type\MusicGroupModel', 'MusicPlaylist' => 'Jolicode\Vocabularies\SchemaOrg\Type\MusicPlaylistModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
