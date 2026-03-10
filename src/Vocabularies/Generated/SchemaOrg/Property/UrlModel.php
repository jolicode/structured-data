<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class UrlModel
{
    public const DESCRIPTION = 'URL of the item.';
    public const LABEL = 'url';
    public const NAME = 'schema:url';
    public const VALUES = ['URLModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\URLModel'];
    public const TYPES = ['Thing' => 'Jolicode\Vocabularies\SchemaOrg\Type\ThingModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
