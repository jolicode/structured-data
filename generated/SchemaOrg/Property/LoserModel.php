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

final class LoserModel
{
    public const DESCRIPTION = 'A sub property of participant. The loser of the action.';
    public const LABEL = 'loser';
    public const NAME = 'schema:loser';
    public const VALUES = ['PersonModel' => 'SchemaOrg\\Type\\PersonModel'];
    public const TYPES = ['WinAction' => 'SchemaOrg\\Type\\WinActionModel'];
}
