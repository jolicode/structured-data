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

final class HomeLocationModel
{
    public const DESCRIPTION = 'A contact location for a person\'s residence.';
    public const LABEL = 'homeLocation';
    public const NAME = 'schema:homeLocation';
    public const VALUES = ['ContactPointModel' => 'SchemaOrg\Type\ContactPointModel', 'PlaceModel' => 'SchemaOrg\Type\PlaceModel'];
    public const TYPES = ['Person' => 'SchemaOrg\Type\PersonModel'];
}
