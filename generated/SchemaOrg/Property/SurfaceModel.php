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

final class SurfaceModel
{
    public const DESCRIPTION = 'A material used as a surface in some artwork, e.g. Canvas, Paper, Wood, Board, etc.';
    public const LABEL = 'surface';
    public const NAME = 'schema:surface';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel', 'URLModel' => 'SchemaOrg\Type\URLModel'];
    public const TYPES = ['VisualArtwork' => 'SchemaOrg\Type\VisualArtworkModel'];
}
