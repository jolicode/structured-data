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

final class ArrivalPlatformModel
{
    public const DESCRIPTION = 'The platform where the train arrives.';
    public const LABEL = 'arrivalPlatform';
    public const NAME = 'schema:arrivalPlatform';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['TrainTrip' => 'SchemaOrg\\Type\\TrainTripModel'];
}
