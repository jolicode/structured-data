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

final class SportModel
{
    public const DESCRIPTION = 'A type of sport (e.g. Baseball).';
    public const LABEL = 'sport';
    public const NAME = 'schema:sport';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel', 'URLModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\URLModel'];
    public const TYPES = ['SportsEvent' => 'Jolicode\Vocabularies\SchemaOrg\Type\SportsEventModel', 'SportsOrganization' => 'Jolicode\Vocabularies\SchemaOrg\Type\SportsOrganizationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
