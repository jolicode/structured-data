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

final class ItemLocationModel
{
    public const DESCRIPTION = 'Current location of the item.';
    public const LABEL = 'itemLocation';
    public const NAME = 'schema:itemLocation';
    public const VALUES = ['PlaceModel' => 'Jolicode\SchemaOrg\Type\PlaceModel', 'PostalAddressModel' => 'Jolicode\SchemaOrg\Type\PostalAddressModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['ArchiveComponent' => 'Jolicode\SchemaOrg\Type\ArchiveComponentModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
