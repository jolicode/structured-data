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

final class ArtformModel
{
    public const DESCRIPTION = 'e.g. Painting, Drawing, Sculpture, Print, Photograph, Assemblage, Collage, etc.';
    public const LABEL = 'artform';
    public const NAME = 'schema:artform';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel', 'URLModel' => 'SchemaOrg\\Type\\URLModel'];
    public const TYPES = ['VisualArtwork' => 'SchemaOrg\\Type\\VisualArtworkModel'];
}
