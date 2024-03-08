<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class GameTipModel
{
    public const DESCRIPTION = 'Links to tips, tactics, etc.';
    public const LABEL = 'gameTip';
    public const NAME = 'schema:gameTip';
    public const VALUES = ['CreativeWorkModel' => 'SchemaOrg\\Type\\CreativeWorkModel'];
    public const TYPES = ['VideoGame' => 'SchemaOrg\\Type\\VideoGameModel'];
}
