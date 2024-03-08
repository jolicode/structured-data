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

final class CssSelectorTypeModel
{
    public const DESCRIPTION = 'Text representing a CSS selector.';
    public const LABEL = 'CssSelectorType';
    public const NAME = 'schema:CssSelectorType';
    public const PARENTS = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const ENUMERATION_MEMBERS = [];

    public function __construct()
    {
    }
}
