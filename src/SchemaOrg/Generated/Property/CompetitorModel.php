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

final class CompetitorModel
{
    public const DESCRIPTION = 'A competitor in a sports event.';
    public const LABEL = 'competitor';
    public const NAME = 'schema:competitor';
    public const VALUES = ['PersonModel' => 'Jolicode\SchemaOrg\Type\PersonModel', 'SportsTeamModel' => 'Jolicode\SchemaOrg\Type\SportsTeamModel'];
    public const TYPES = ['SportsEvent' => 'Jolicode\SchemaOrg\Type\SportsEventModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
