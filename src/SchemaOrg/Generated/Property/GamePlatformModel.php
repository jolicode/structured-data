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

final class GamePlatformModel
{
    public const DESCRIPTION = 'The electronic systems used to play <a href="http://en.wikipedia.org/wiki/Category:Video_game_platforms">video games</a>.';
    public const LABEL = 'gamePlatform';
    public const NAME = 'schema:gamePlatform';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel', 'ThingModel' => 'Jolicode\SchemaOrg\Type\ThingModel', 'URLModel' => 'Jolicode\SchemaOrg\Type\URLModel'];
    public const TYPES = ['VideoGame' => 'Jolicode\SchemaOrg\Type\VideoGameModel', 'VideoGameSeries' => 'Jolicode\SchemaOrg\Type\VideoGameSeriesModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
