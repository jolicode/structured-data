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

final class ByArtistModel
{
    public const DESCRIPTION = 'The artist that performed this album or recording.';
    public const LABEL = 'byArtist';
    public const NAME = 'schema:byArtist';
    public const VALUES = ['MusicGroupModel' => 'SchemaOrg\\Type\\MusicGroupModel', 'PersonModel' => 'SchemaOrg\\Type\\PersonModel'];
    public const TYPES = ['MusicAlbum' => 'SchemaOrg\\Type\\MusicAlbumModel', 'MusicRecording' => 'SchemaOrg\\Type\\MusicRecordingModel'];
}
