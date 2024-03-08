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

final class AreaModel
{
    public const DESCRIPTION = 'The area within which users can expect to reach the broadcast service.';
    public const LABEL = 'area';
    public const NAME = 'schema:area';
    public const VALUES = ['PlaceModel' => 'SchemaOrg\Type\PlaceModel'];
    public const TYPES = ['BroadcastService' => 'SchemaOrg\Type\BroadcastServiceModel'];
}
