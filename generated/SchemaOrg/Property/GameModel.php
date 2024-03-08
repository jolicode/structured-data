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

final class GameModel
{
    public const DESCRIPTION = 'Video game which is played on this server.';
    public const LABEL = 'game';
    public const NAME = 'schema:game';
    public const VALUES = ['VideoGameModel' => 'SchemaOrg\\Type\\VideoGameModel'];
    public const TYPES = ['GameServer' => 'SchemaOrg\\Type\\GameServerModel'];
}
