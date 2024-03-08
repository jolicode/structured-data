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

final class HomeTeamModel
{
    public const DESCRIPTION = 'The home team in a sports event.';
    public const LABEL = 'homeTeam';
    public const NAME = 'schema:homeTeam';
    public const VALUES = ['PersonModel' => 'SchemaOrg\Type\PersonModel', 'SportsTeamModel' => 'SchemaOrg\Type\SportsTeamModel'];
    public const TYPES = ['SportsEvent' => 'SchemaOrg\Type\SportsEventModel'];
}
