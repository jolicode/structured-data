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

final class HasCategoryCodeModel
{
    public const DESCRIPTION = 'A Category code contained in this code set.';
    public const LABEL = 'hasCategoryCode';
    public const NAME = 'schema:hasCategoryCode';
    public const VALUES = ['CategoryCodeModel' => 'SchemaOrg\\Type\\CategoryCodeModel'];
    public const TYPES = ['CategoryCodeSet' => 'SchemaOrg\\Type\\CategoryCodeSetModel'];
}
