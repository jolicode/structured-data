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

final class DeparturePlatformModel
{
    public const DESCRIPTION = 'The platform from which the train departs.';
    public const LABEL = 'departurePlatform';
    public const NAME = 'schema:departurePlatform';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['TrainTrip' => 'SchemaOrg\Type\TrainTripModel'];
}
