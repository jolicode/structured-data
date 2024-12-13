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

final class PolygonModel
{
    public const DESCRIPTION = 'A polygon is the area enclosed by a point-to-point path for which the starting and ending points are the same. A polygon is expressed as a series of four or more space delimited points where the first and final points are identical.';
    public const LABEL = 'polygon';
    public const NAME = 'schema:polygon';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['GeoShape' => 'Jolicode\SchemaOrg\Type\GeoShapeModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
