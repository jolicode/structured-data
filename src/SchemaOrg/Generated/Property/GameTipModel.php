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

final class GameTipModel
{
    public const DESCRIPTION = 'Links to tips, tactics, etc.';
    public const LABEL = 'gameTip';
    public const NAME = 'schema:gameTip';
    public const VALUES = ['CreativeWorkModel' => 'Jolicode\SchemaOrg\Type\CreativeWorkModel'];
    public const TYPES = ['VideoGame' => 'Jolicode\SchemaOrg\Type\VideoGameModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
