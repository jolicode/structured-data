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

final class LocationCreatedModel
{
    public const DESCRIPTION = 'The location where the CreativeWork was created, which may not be the same as the location depicted in the CreativeWork.';
    public const LABEL = 'locationCreated';
    public const NAME = 'schema:locationCreated';
    public const VALUES = ['PlaceModel' => 'Jolicode\SchemaOrg\Type\PlaceModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\SchemaOrg\Type\CreativeWorkModel'];
}
