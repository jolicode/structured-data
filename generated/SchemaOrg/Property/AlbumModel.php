<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class AlbumModel
{
    public const DESCRIPTION = 'A music album.';
    public const LABEL = 'album';
    public const NAME = 'schema:album';
    public const VALUES = ['MusicAlbumModel' => 'SchemaOrg\Type\MusicAlbumModel'];
    public const TYPES = ['MusicGroup' => 'SchemaOrg\Type\MusicGroupModel'];
}
