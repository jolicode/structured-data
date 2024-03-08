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

final class ReplaceeModel
{
    public const DESCRIPTION = 'A sub property of object. The object that is being replaced.';
    public const LABEL = 'replacee';
    public const NAME = 'schema:replacee';
    public const VALUES = ['ThingModel' => 'SchemaOrg\\Type\\ThingModel'];
    public const TYPES = ['ReplaceAction' => 'SchemaOrg\\Type\\ReplaceActionModel'];
}
