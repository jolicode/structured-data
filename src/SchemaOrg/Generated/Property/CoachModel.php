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

final class CoachModel
{
    public const DESCRIPTION = 'A person that acts in a coaching role for a sports team.';
    public const LABEL = 'coach';
    public const NAME = 'schema:coach';
    public const VALUES = ['PersonModel' => 'Jolicode\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['SportsTeam' => 'Jolicode\SchemaOrg\Type\SportsTeamModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
