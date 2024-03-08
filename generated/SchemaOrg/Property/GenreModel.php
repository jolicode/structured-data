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

final class GenreModel
{
    public const DESCRIPTION = 'Genre of the creative work, broadcast channel or group.';
    public const LABEL = 'genre';
    public const NAME = 'schema:genre';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel', 'URLModel' => 'SchemaOrg\Type\URLModel'];
    public const TYPES = ['BroadcastChannel' => 'SchemaOrg\Type\BroadcastChannelModel', 'CreativeWork' => 'SchemaOrg\Type\CreativeWorkModel', 'MusicGroup' => 'SchemaOrg\Type\MusicGroupModel'];
}
