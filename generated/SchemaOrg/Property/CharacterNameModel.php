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

final class CharacterNameModel
{
    public const DESCRIPTION = 'The name of a character played in some acting or performing role, i.e. in a PerformanceRole.';
    public const LABEL = 'characterName';
    public const NAME = 'schema:characterName';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['PerformanceRole' => 'SchemaOrg\\Type\\PerformanceRoleModel'];
}
