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

final class ItemLocationModel
{
    public const DESCRIPTION = 'Current location of the item.';
    public const LABEL = 'itemLocation';
    public const NAME = 'schema:itemLocation';
    public const VALUES = ['PlaceModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PlaceModel', 'PostalAddressModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PostalAddressModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['ArchiveComponent' => 'Jolicode\Vocabularies\SchemaOrg\Type\ArchiveComponentModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
