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

final class ReplacerModel
{
    public const DESCRIPTION = 'A sub property of object. The object that replaces.';
    public const LABEL = 'replacer';
    public const NAME = 'schema:replacer';
    public const VALUES = ['ThingModel' => 'Jolicode\SchemaOrg\Type\ThingModel'];
    public const TYPES = ['ReplaceAction' => 'Jolicode\SchemaOrg\Type\ReplaceActionModel'];
}
