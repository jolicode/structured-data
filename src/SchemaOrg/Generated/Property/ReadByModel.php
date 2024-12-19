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

final class ReadByModel
{
    public const DESCRIPTION = 'A person who reads (performs) the audiobook.';
    public const LABEL = 'readBy';
    public const NAME = 'schema:readBy';
    public const VALUES = ['PersonModel' => 'Jolicode\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Audiobook' => 'Jolicode\SchemaOrg\Type\AudiobookModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
