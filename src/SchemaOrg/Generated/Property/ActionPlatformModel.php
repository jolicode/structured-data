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

final class ActionPlatformModel
{
    public const DESCRIPTION = 'The high level platform(s) where the Action can be performed for the given URL. To specify a specific application or operating system instance, use actionApplication.';
    public const LABEL = 'actionPlatform';
    public const NAME = 'schema:actionPlatform';
    public const VALUES = ['DigitalPlatformEnumerationModel' => 'Jolicode\SchemaOrg\Type\DigitalPlatformEnumerationModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel', 'URLModel' => 'Jolicode\SchemaOrg\Type\URLModel'];
    public const TYPES = ['EntryPoint' => 'Jolicode\SchemaOrg\Type\EntryPointModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
