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

final class SportsEventModel
{
    public const DESCRIPTION = 'A sub property of location. The sports event where this action occurred.';
    public const LABEL = 'sportsEvent';
    public const NAME = 'schema:sportsEvent';
    public const VALUES = ['SportsEventModel' => 'SchemaOrg\Type\SportsEventModel'];
    public const TYPES = ['ExerciseAction' => 'SchemaOrg\Type\ExerciseActionModel'];
}
