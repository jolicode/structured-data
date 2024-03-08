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

final class ReleaseOfModel
{
    public const DESCRIPTION = 'The album this is a release of.';
    public const LABEL = 'releaseOf';
    public const NAME = 'schema:releaseOf';
    public const VALUES = ['MusicAlbumModel' => 'SchemaOrg\Type\MusicAlbumModel'];
    public const TYPES = ['MusicRelease' => 'SchemaOrg\Type\MusicReleaseModel'];
}
