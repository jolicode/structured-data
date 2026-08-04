<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class ItemLocationModel
{
    public const DESCRIPTION = 'Current location of the item.';
    public const LABEL = 'itemLocation';
    public const NAME = 'schema:itemLocation';
    public const VALUES = ['PlaceModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PlaceModel', 'PostalAddressModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PostalAddressModel', 'TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['ArchiveComponent' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ArchiveComponentModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1758'];
    public const SUPERSEDED_BY = null;
}
