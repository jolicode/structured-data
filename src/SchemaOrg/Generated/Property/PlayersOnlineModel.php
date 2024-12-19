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

final class PlayersOnlineModel
{
    public const DESCRIPTION = 'Number of players on the server.';
    public const LABEL = 'playersOnline';
    public const NAME = 'schema:playersOnline';
    public const VALUES = ['IntegerModel' => 'Jolicode\SchemaOrg\Type\IntegerModel'];
    public const TYPES = ['GameServer' => 'Jolicode\SchemaOrg\Type\GameServerModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
