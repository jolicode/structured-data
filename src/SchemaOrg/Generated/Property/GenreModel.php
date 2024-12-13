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

final class GenreModel
{
    public const DESCRIPTION = 'Genre of the creative work, broadcast channel or group.';
    public const LABEL = 'genre';
    public const NAME = 'schema:genre';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel', 'URLModel' => 'Jolicode\SchemaOrg\Type\URLModel'];
    public const TYPES = ['BroadcastChannel' => 'Jolicode\SchemaOrg\Type\BroadcastChannelModel', 'CreativeWork' => 'Jolicode\SchemaOrg\Type\CreativeWorkModel', 'MusicGroup' => 'Jolicode\SchemaOrg\Type\MusicGroupModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
