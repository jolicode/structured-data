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

final class ArtformModel
{
    public const DESCRIPTION = 'e.g. Painting, Drawing, Sculpture, Print, Photograph, Assemblage, Collage, etc.';
    public const LABEL = 'artform';
    public const NAME = 'schema:artform';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel', 'URLModel' => 'Jolicode\SchemaOrg\Type\URLModel'];
    public const TYPES = ['VisualArtwork' => 'Jolicode\SchemaOrg\Type\VisualArtworkModel'];
}
