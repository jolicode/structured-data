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

final class ObservationAboutModel
{
    public const DESCRIPTION = 'The [[observationAbout]] property identifies an entity, often a [[Place]], associated with an [[Observation]].';
    public const LABEL = 'observationAbout';
    public const NAME = 'schema:observationAbout';
    public const VALUES = ['PlaceModel' => 'SchemaOrg\Type\PlaceModel', 'ThingModel' => 'SchemaOrg\Type\ThingModel'];
    public const TYPES = ['Observation' => 'SchemaOrg\Type\ObservationModel'];
}
