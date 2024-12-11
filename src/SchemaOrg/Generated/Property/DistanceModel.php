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

final class DistanceModel
{
    public const DESCRIPTION = 'The distance travelled, e.g. exercising or travelling.';
    public const LABEL = 'distance';
    public const NAME = 'schema:distance';
    public const VALUES = ['DistanceModel' => 'Jolicode\SchemaOrg\Type\DistanceModel'];
    public const TYPES = ['ExerciseAction' => 'Jolicode\SchemaOrg\Type\ExerciseActionModel', 'TravelAction' => 'Jolicode\SchemaOrg\Type\TravelActionModel'];
}
