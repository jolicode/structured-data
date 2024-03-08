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

final class SmokingAllowedModel
{
    public const DESCRIPTION = 'Indicates whether it is allowed to smoke in the place, e.g. in the restaurant, hotel or hotel room.';
    public const LABEL = 'smokingAllowed';
    public const NAME = 'schema:smokingAllowed';
    public const VALUES = ['BooleanModel' => 'SchemaOrg\\Type\\BooleanModel'];
    public const TYPES = ['Place' => 'SchemaOrg\\Type\\PlaceModel'];
}
