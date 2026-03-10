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

final class GameModel
{
    public const DESCRIPTION = 'Video game which is played on this server.';
    public const LABEL = 'game';
    public const NAME = 'schema:game';
    public const VALUES = ['VideoGameModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\VideoGameModel'];
    public const TYPES = ['GameServer' => 'Jolicode\Vocabularies\SchemaOrg\Type\GameServerModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
