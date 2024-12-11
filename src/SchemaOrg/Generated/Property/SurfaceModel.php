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

final class SurfaceModel
{
    public const DESCRIPTION = 'A material used as a surface in some artwork, e.g. Canvas, Paper, Wood, Board, etc.';
    public const LABEL = 'surface';
    public const NAME = 'schema:surface';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel', 'URLModel' => 'Jolicode\SchemaOrg\Type\URLModel'];
    public const TYPES = ['VisualArtwork' => 'Jolicode\SchemaOrg\Type\VisualArtworkModel'];
}
