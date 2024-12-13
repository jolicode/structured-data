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

final class HttpMethodModel
{
    public const DESCRIPTION = 'An HTTP method that specifies the appropriate HTTP method for a request to an HTTP EntryPoint. Values are capitalized strings as used in HTTP.';
    public const LABEL = 'httpMethod';
    public const NAME = 'schema:httpMethod';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['EntryPoint' => 'Jolicode\SchemaOrg\Type\EntryPointModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
