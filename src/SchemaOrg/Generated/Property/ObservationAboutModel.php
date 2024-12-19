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

final class ObservationAboutModel
{
    public const DESCRIPTION = 'The [[observationAbout]] property identifies an entity, often a [[Place]], associated with an [[Observation]].';
    public const LABEL = 'observationAbout';
    public const NAME = 'schema:observationAbout';
    public const VALUES = ['PlaceModel' => 'Jolicode\SchemaOrg\Type\PlaceModel', 'ThingModel' => 'Jolicode\SchemaOrg\Type\ThingModel'];
    public const TYPES = ['Observation' => 'Jolicode\SchemaOrg\Type\ObservationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
