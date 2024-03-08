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

namespace SchemaOrg\Type;

final class XPathTypeModel
{
    public const DESCRIPTION = 'Text representing an XPath (typically but not necessarily version 1.0).';
    public const LABEL = 'XPathType';
    public const NAME = 'schema:XPathType';
    public const PARENTS = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const ENUMERATION_MEMBERS = [];

    public function __construct()
    {
    }
}
