<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class TrackModel
{
    public const DESCRIPTION = 'A music recording (track)&#x2014;usually a single song. If an ItemList is given, the list should contain items of type MusicRecording.';
    public const LABEL = 'track';
    public const NAME = 'schema:track';
    public const VALUES = ['ItemListModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ItemListModel', 'MusicRecordingModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MusicRecordingModel'];
    public const TYPES = ['MusicGroup' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MusicGroupModel', 'MusicPlaylist' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MusicPlaylistModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
