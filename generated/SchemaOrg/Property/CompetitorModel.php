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

final class CompetitorModel
{
    public const DESCRIPTION = 'A competitor in a sports event.';
    public const LABEL = 'competitor';
    public const NAME = 'schema:competitor';
    public const VALUES = ['PersonModel' => 'SchemaOrg\Type\PersonModel', 'SportsTeamModel' => 'SchemaOrg\Type\SportsTeamModel'];
    public const TYPES = ['SportsEvent' => 'SchemaOrg\Type\SportsEventModel'];
}
