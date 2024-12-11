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

final class TripOriginModel
{
    public const DESCRIPTION = 'The location of origin of the trip, prior to any destination(s).';
    public const LABEL = 'tripOrigin';
    public const NAME = 'schema:tripOrigin';
    public const VALUES = ['PlaceModel' => 'Jolicode\SchemaOrg\Type\PlaceModel'];
    public const TYPES = ['Trip' => 'Jolicode\SchemaOrg\Type\TripModel'];
}
