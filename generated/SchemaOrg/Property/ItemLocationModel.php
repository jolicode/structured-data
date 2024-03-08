<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class ItemLocationModel
{
    public const DESCRIPTION = 'Current location of the item.';
    public const LABEL = 'itemLocation';
    public const NAME = 'schema:itemLocation';
    public const VALUES = ['PlaceModel' => 'SchemaOrg\Type\PlaceModel', 'PostalAddressModel' => 'SchemaOrg\Type\PostalAddressModel', 'TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['ArchiveComponent' => 'SchemaOrg\Type\ArchiveComponentModel'];
}
