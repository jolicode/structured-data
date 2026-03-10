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

final class ServerStatusModel
{
    public const DESCRIPTION = 'Status of a game server.';
    public const LABEL = 'serverStatus';
    public const NAME = 'schema:serverStatus';
    public const VALUES = ['GameServerStatusModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\GameServerStatusModel'];
    public const TYPES = ['GameServer' => 'Jolicode\Vocabularies\SchemaOrg\Type\GameServerModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
