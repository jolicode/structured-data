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

final class DistanceModel
{
    public const DESCRIPTION = 'The distance travelled, e.g. exercising or travelling.';
    public const LABEL = 'distance';
    public const NAME = 'schema:distance';
    public const VALUES = ['DistanceModel' => 'SchemaOrg\\Type\\DistanceModel'];
    public const TYPES = ['ExerciseAction' => 'SchemaOrg\\Type\\ExerciseActionModel', 'TravelAction' => 'SchemaOrg\\Type\\TravelActionModel'];
}
