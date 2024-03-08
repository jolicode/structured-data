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

final class MusicalKeyModel
{
    public const DESCRIPTION = 'The key, mode, or scale this composition uses.';
    public const LABEL = 'musicalKey';
    public const NAME = 'schema:musicalKey';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['MusicComposition' => 'SchemaOrg\\Type\\MusicCompositionModel'];
}
