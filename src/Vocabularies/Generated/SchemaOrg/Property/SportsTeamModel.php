<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class SportsTeamModel
{
    public const DESCRIPTION = 'A sub property of participant. The sports team that participated on this action.';
    public const LABEL = 'sportsTeam';
    public const NAME = 'schema:sportsTeam';
    public const VALUES = ['SportsTeamModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\SportsTeamModel'];
    public const TYPES = ['ExerciseAction' => 'Jolicode\Vocabularies\SchemaOrg\Type\ExerciseActionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
