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

final class AlbumReleaseTypeModel
{
    public const DESCRIPTION = 'The kind of release which this album is: single, EP or album.';
    public const LABEL = 'albumReleaseType';
    public const NAME = 'schema:albumReleaseType';
    public const VALUES = ['MusicAlbumReleaseTypeModel' => 'SchemaOrg\\Type\\MusicAlbumReleaseTypeModel'];
    public const TYPES = ['MusicAlbum' => 'SchemaOrg\\Type\\MusicAlbumModel'];
}
