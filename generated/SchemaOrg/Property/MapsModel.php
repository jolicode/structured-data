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

final class MapsModel
{
    public const DESCRIPTION = 'A URL to a map of the place.';
    public const LABEL = 'maps';
    public const NAME = 'schema:maps';
    public const VALUES = ['URLModel' => 'SchemaOrg\\Type\\URLModel'];
    public const TYPES = ['Place' => 'SchemaOrg\\Type\\PlaceModel'];
}
