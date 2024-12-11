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

final class LyricsModel
{
    public const DESCRIPTION = 'The words in the song.';
    public const LABEL = 'lyrics';
    public const NAME = 'schema:lyrics';
    public const VALUES = ['CreativeWorkModel' => 'Jolicode\SchemaOrg\Type\CreativeWorkModel'];
    public const TYPES = ['MusicComposition' => 'Jolicode\SchemaOrg\Type\MusicCompositionModel'];
}
