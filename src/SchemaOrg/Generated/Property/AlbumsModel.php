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

final class AlbumsModel
{
    public const DESCRIPTION = 'A collection of music albums.';
    public const LABEL = 'albums';
    public const NAME = 'schema:albums';
    public const VALUES = ['MusicAlbumModel' => 'Jolicode\SchemaOrg\Type\MusicAlbumModel'];
    public const TYPES = ['MusicGroup' => 'Jolicode\SchemaOrg\Type\MusicGroupModel'];
}
