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

final class AthleteModel
{
    public const DESCRIPTION = 'A person that acts as performing member of a sports team; a player as opposed to a coach.';
    public const LABEL = 'athlete';
    public const NAME = 'schema:athlete';
    public const VALUES = ['PersonModel' => 'Jolicode\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['SportsTeam' => 'Jolicode\SchemaOrg\Type\SportsTeamModel'];
}
