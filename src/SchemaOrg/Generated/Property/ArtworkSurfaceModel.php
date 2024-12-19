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

final class ArtworkSurfaceModel
{
    public const DESCRIPTION = 'The supporting materials for the artwork, e.g. Canvas, Paper, Wood, Board, etc.';
    public const LABEL = 'artworkSurface';
    public const NAME = 'schema:artworkSurface';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel', 'URLModel' => 'Jolicode\SchemaOrg\Type\URLModel'];
    public const TYPES = ['VisualArtwork' => 'Jolicode\SchemaOrg\Type\VisualArtworkModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
