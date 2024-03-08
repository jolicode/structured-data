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

final class ActionPlatformModel
{
    public const DESCRIPTION = 'The high level platform(s) where the Action can be performed for the given URL. To specify a specific application or operating system instance, use actionApplication.';
    public const LABEL = 'actionPlatform';
    public const NAME = 'schema:actionPlatform';
    public const VALUES = ['DigitalPlatformEnumerationModel' => 'SchemaOrg\\Type\\DigitalPlatformEnumerationModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel', 'URLModel' => 'SchemaOrg\\Type\\URLModel'];
    public const TYPES = ['EntryPoint' => 'SchemaOrg\\Type\\EntryPointModel'];
}
