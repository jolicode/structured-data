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

final class GameServerModel
{
    public const DESCRIPTION = 'The server on which  it is possible to play the game.';
    public const LABEL = 'gameServer';
    public const NAME = 'schema:gameServer';
    public const VALUES = ['GameServerModel' => 'Jolicode\SchemaOrg\Type\GameServerModel'];
    public const TYPES = ['VideoGame' => 'Jolicode\SchemaOrg\Type\VideoGameModel'];
}
