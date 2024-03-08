<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class SportModel
{
    public const DESCRIPTION = 'A type of sport (e.g. Baseball).';
    public const LABEL = 'sport';
    public const NAME = 'schema:sport';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel', 'URLModel' => 'SchemaOrg\\Type\\URLModel'];
    public const TYPES = ['SportsEvent' => 'SchemaOrg\\Type\\SportsEventModel', 'SportsOrganization' => 'SchemaOrg\\Type\\SportsOrganizationModel'];
}
