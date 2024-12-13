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

final class SportModel
{
    public const DESCRIPTION = 'A type of sport (e.g. Baseball).';
    public const LABEL = 'sport';
    public const NAME = 'schema:sport';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel', 'URLModel' => 'Jolicode\SchemaOrg\Type\URLModel'];
    public const TYPES = ['SportsEvent' => 'Jolicode\SchemaOrg\Type\SportsEventModel', 'SportsOrganization' => 'Jolicode\SchemaOrg\Type\SportsOrganizationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
