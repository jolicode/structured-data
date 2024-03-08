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

final class ContainsPlaceModel
{
    public const DESCRIPTION = 'The basic containment relation between a place and another that it contains.';
    public const LABEL = 'containsPlace';
    public const NAME = 'schema:containsPlace';
    public const VALUES = ['PlaceModel' => 'SchemaOrg\\Type\\PlaceModel'];
    public const TYPES = ['Place' => 'SchemaOrg\\Type\\PlaceModel'];
}
