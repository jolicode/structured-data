<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class GenreModel
{
    public const DESCRIPTION = 'Genre of the creative work, broadcast channel or group.';
    public const LABEL = 'genre';
    public const NAME = 'schema:genre';
    public const VALUES = ['DefinedTermModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DefinedTermModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel', 'URLModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\URLModel'];
    public const TYPES = ['BroadcastChannel' => 'Jolicode\Vocabularies\SchemaOrg\Type\BroadcastChannelModel', 'CreativeWork' => 'Jolicode\Vocabularies\SchemaOrg\Type\CreativeWorkModel', 'MusicGroup' => 'Jolicode\Vocabularies\SchemaOrg\Type\MusicGroupModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
