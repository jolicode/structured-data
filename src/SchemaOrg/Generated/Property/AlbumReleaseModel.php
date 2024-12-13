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

final class AlbumReleaseModel
{
    public const DESCRIPTION = 'A release of this album.';
    public const LABEL = 'albumRelease';
    public const NAME = 'schema:albumRelease';
    public const VALUES = ['MusicReleaseModel' => 'Jolicode\SchemaOrg\Type\MusicReleaseModel'];
    public const TYPES = ['MusicAlbum' => 'Jolicode\SchemaOrg\Type\MusicAlbumModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
