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

final class ArtEditionModel
{
    public const DESCRIPTION = 'The number of copies when multiple copies of a piece of artwork are produced - e.g. for a limited edition of 20 prints, \'artEdition\' refers to the total number of copies (in this example "20").';
    public const LABEL = 'artEdition';
    public const NAME = 'schema:artEdition';
    public const VALUES = ['IntegerModel' => 'SchemaOrg\\Type\\IntegerModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['VisualArtwork' => 'SchemaOrg\\Type\\VisualArtworkModel'];
}
