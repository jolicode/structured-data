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

final class InCodeSetModel
{
    public const DESCRIPTION = 'A [[CategoryCodeSet]] that contains this category code.';
    public const LABEL = 'inCodeSet';
    public const NAME = 'schema:inCodeSet';
    public const VALUES = ['CategoryCodeSetModel' => 'SchemaOrg\\Type\\CategoryCodeSetModel', 'URLModel' => 'SchemaOrg\\Type\\URLModel'];
    public const TYPES = ['CategoryCode' => 'SchemaOrg\\Type\\CategoryCodeModel'];
}
