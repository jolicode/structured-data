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

final class QuestModel
{
    public const DESCRIPTION = 'The task that a player-controlled character, or group of characters may complete in order to gain a reward.';
    public const LABEL = 'quest';
    public const NAME = 'schema:quest';
    public const VALUES = ['ThingModel' => 'Jolicode\SchemaOrg\Type\ThingModel'];
    public const TYPES = ['Game' => 'Jolicode\SchemaOrg\Type\GameModel', 'VideoGameSeries' => 'Jolicode\SchemaOrg\Type\VideoGameSeriesModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
