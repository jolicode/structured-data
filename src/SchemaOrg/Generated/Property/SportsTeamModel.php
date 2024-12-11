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

final class SportsTeamModel
{
    public const DESCRIPTION = 'A sub property of participant. The sports team that participated on this action.';
    public const LABEL = 'sportsTeam';
    public const NAME = 'schema:sportsTeam';
    public const VALUES = ['SportsTeamModel' => 'Jolicode\SchemaOrg\Type\SportsTeamModel'];
    public const TYPES = ['ExerciseAction' => 'Jolicode\SchemaOrg\Type\ExerciseActionModel'];
}
