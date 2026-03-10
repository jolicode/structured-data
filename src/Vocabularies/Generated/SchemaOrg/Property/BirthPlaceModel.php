<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class BirthPlaceModel
{
    public const DESCRIPTION = 'The place where the person was born.';
    public const LABEL = 'birthPlace';
    public const NAME = 'schema:birthPlace';
    public const VALUES = ['PlaceModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PlaceModel'];
    public const TYPES = ['Person' => 'Jolicode\Vocabularies\SchemaOrg\Type\PersonModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
