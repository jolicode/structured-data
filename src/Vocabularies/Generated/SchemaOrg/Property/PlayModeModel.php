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

final class PlayModeModel
{
    public const DESCRIPTION = 'Indicates whether this game is multi-player, co-op or single-player.  The game can be marked as multi-player, co-op and single-player at the same time.';
    public const LABEL = 'playMode';
    public const NAME = 'schema:playMode';
    public const VALUES = ['GamePlayModeModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\GamePlayModeModel'];
    public const TYPES = ['VideoGame' => 'Jolicode\Vocabularies\SchemaOrg\Type\VideoGameModel', 'VideoGameSeries' => 'Jolicode\Vocabularies\SchemaOrg\Type\VideoGameSeriesModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
