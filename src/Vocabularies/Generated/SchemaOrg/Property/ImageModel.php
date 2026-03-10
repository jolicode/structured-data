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

final class ImageModel
{
    public const DESCRIPTION = 'An image of the item. This can be a [[URL]] or a fully described [[ImageObject]].';
    public const LABEL = 'image';
    public const NAME = 'schema:image';
    public const VALUES = ['ImageObjectModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\ImageObjectModel', 'URLModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\URLModel'];
    public const TYPES = ['Thing' => 'Jolicode\Vocabularies\SchemaOrg\Type\ThingModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
