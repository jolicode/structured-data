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

final class InCodeSetModel
{
    public const DESCRIPTION = 'A [[CategoryCodeSet]] that contains this category code.';
    public const LABEL = 'inCodeSet';
    public const NAME = 'schema:inCodeSet';
    public const VALUES = ['CategoryCodeSetModel' => 'Jolicode\SchemaOrg\Type\CategoryCodeSetModel', 'URLModel' => 'Jolicode\SchemaOrg\Type\URLModel'];
    public const TYPES = ['CategoryCode' => 'Jolicode\SchemaOrg\Type\CategoryCodeModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
