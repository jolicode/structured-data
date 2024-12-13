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

final class BoxModel
{
    public const DESCRIPTION = 'A box is the area enclosed by the rectangle formed by two points. The first point is the lower corner, the second point is the upper corner. A box is expressed as two points separated by a space character.';
    public const LABEL = 'box';
    public const NAME = 'schema:box';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['GeoShape' => 'Jolicode\SchemaOrg\Type\GeoShapeModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
