<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class PostalCodePrefixModel
{
    public const DESCRIPTION = 'A defined range of postal codes indicated by a common textual prefix. Used for non-numeric systems such as UK.';
    public const LABEL = 'postalCodePrefix';
    public const NAME = 'schema:postalCodePrefix';
    public const VALUES = ['TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['DefinedRegion' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DefinedRegionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2506'];
    public const SUPERSEDED_BY = null;
}
