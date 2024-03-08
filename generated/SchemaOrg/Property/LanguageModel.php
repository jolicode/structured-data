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

final class LanguageModel
{
    public const DESCRIPTION = 'A sub property of instrument. The language used on this action.';
    public const LABEL = 'language';
    public const NAME = 'schema:language';
    public const VALUES = ['LanguageModel' => 'SchemaOrg\\Type\\LanguageModel'];
    public const TYPES = ['CommunicateAction' => 'SchemaOrg\\Type\\CommunicateActionModel', 'WriteAction' => 'SchemaOrg\\Type\\WriteActionModel'];
}
