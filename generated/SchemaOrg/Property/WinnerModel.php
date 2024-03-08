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

final class WinnerModel
{
    public const DESCRIPTION = 'A sub property of participant. The winner of the action.';
    public const LABEL = 'winner';
    public const NAME = 'schema:winner';
    public const VALUES = ['PersonModel' => 'SchemaOrg\\Type\\PersonModel'];
    public const TYPES = ['LoseAction' => 'SchemaOrg\\Type\\LoseActionModel'];
}
