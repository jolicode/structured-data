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

final class ContainedInPlaceModel
{
    public const DESCRIPTION = 'The basic containment relation between a place and one that contains it.';
    public const LABEL = 'containedInPlace';
    public const NAME = 'schema:containedInPlace';
    public const VALUES = ['PlaceModel' => 'SchemaOrg\Type\PlaceModel'];
    public const TYPES = ['Place' => 'SchemaOrg\Type\PlaceModel'];
}
