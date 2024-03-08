<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class GamePlatformModel
{
    public const DESCRIPTION = 'The electronic systems used to play <a href="http://en.wikipedia.org/wiki/Category:Video_game_platforms">video games</a>.';
    public const LABEL = 'gamePlatform';
    public const NAME = 'schema:gamePlatform';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel', 'ThingModel' => 'SchemaOrg\Type\ThingModel', 'URLModel' => 'SchemaOrg\Type\URLModel'];
    public const TYPES = ['VideoGame' => 'SchemaOrg\Type\VideoGameModel', 'VideoGameSeries' => 'SchemaOrg\Type\VideoGameSeriesModel'];
}
