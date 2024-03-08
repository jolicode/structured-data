<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Type;

final class URLModel
{
    public const DESCRIPTION = 'Data type: URL.';
    public const LABEL = 'URL';
    public const NAME = 'schema:URL';
    public const PARENTS = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const ENUMERATION_MEMBERS = [];

    public function __construct()
    {
    }
}
