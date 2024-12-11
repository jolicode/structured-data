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

final class LineModel
{
    public const DESCRIPTION = 'A line is a point-to-point path consisting of two or more points. A line is expressed as a series of two or more point objects separated by space.';
    public const LABEL = 'line';
    public const NAME = 'schema:line';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['GeoShape' => 'Jolicode\SchemaOrg\Type\GeoShapeModel'];
}
