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

final class AlbumProductionTypeModel
{
    public const DESCRIPTION = 'Classification of the album by its type of content: soundtrack, live album, studio album, etc.';
    public const LABEL = 'albumProductionType';
    public const NAME = 'schema:albumProductionType';
    public const VALUES = ['MusicAlbumProductionTypeModel' => 'Jolicode\SchemaOrg\Type\MusicAlbumProductionTypeModel'];
    public const TYPES = ['MusicAlbum' => 'Jolicode\SchemaOrg\Type\MusicAlbumModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
