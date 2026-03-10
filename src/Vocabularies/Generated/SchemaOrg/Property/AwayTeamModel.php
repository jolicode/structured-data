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

final class AwayTeamModel
{
    public const DESCRIPTION = 'The away team in a sports event.';
    public const LABEL = 'awayTeam';
    public const NAME = 'schema:awayTeam';
    public const VALUES = ['PersonModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PersonModel', 'SportsTeamModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\SportsTeamModel'];
    public const TYPES = ['SportsEvent' => 'Jolicode\Vocabularies\SchemaOrg\Type\SportsEventModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
