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

final class DeathPlaceModel
{
    public const DESCRIPTION = 'The place where the person died.';
    public const LABEL = 'deathPlace';
    public const NAME = 'schema:deathPlace';
    public const VALUES = ['PlaceModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PlaceModel'];
    public const TYPES = ['Person' => 'Jolicode\Vocabularies\SchemaOrg\Type\PersonModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
