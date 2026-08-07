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

final class ByArtistModel
{
    public const DESCRIPTION = 'The artist that performed this album or recording.';
    public const LABEL = 'byArtist';
    public const NAME = 'schema:byArtist';
    public const VALUES = ['MusicGroupModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MusicGroupModel', 'PersonModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['MusicAlbum' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MusicAlbumModel', 'MusicRecording' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MusicRecordingModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
