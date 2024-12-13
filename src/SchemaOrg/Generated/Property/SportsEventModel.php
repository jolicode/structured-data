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

final class SportsEventModel
{
    public const DESCRIPTION = 'A sub property of location. The sports event where this action occurred.';
    public const LABEL = 'sportsEvent';
    public const NAME = 'schema:sportsEvent';
    public const VALUES = ['SportsEventModel' => 'Jolicode\SchemaOrg\Type\SportsEventModel'];
    public const TYPES = ['ExerciseAction' => 'Jolicode\SchemaOrg\Type\ExerciseActionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
