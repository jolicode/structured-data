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

final class GameItemModel
{
    public const DESCRIPTION = 'An item is an object within the game world that can be collected by a player or, occasionally, a non-player character.';
    public const LABEL = 'gameItem';
    public const NAME = 'schema:gameItem';
    public const VALUES = ['ThingModel' => 'Jolicode\SchemaOrg\Type\ThingModel'];
    public const TYPES = ['Game' => 'Jolicode\SchemaOrg\Type\GameModel', 'VideoGameSeries' => 'Jolicode\SchemaOrg\Type\VideoGameSeriesModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
