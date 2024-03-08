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

final class BoxModel
{
    public const DESCRIPTION = 'A box is the area enclosed by the rectangle formed by two points. The first point is the lower corner, the second point is the upper corner. A box is expressed as two points separated by a space character.';
    public const LABEL = 'box';
    public const NAME = 'schema:box';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['GeoShape' => 'SchemaOrg\\Type\\GeoShapeModel'];
}
