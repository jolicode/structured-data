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

final class NumTracksModel
{
    public const DESCRIPTION = 'The number of tracks in this album or playlist.';
    public const LABEL = 'numTracks';
    public const NAME = 'schema:numTracks';
    public const VALUES = ['IntegerModel' => 'SchemaOrg\\Type\\IntegerModel'];
    public const TYPES = ['MusicPlaylist' => 'SchemaOrg\\Type\\MusicPlaylistModel'];
}
