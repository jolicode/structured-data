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

final class PostalCodeEndModel
{
    public const DESCRIPTION = 'Last postal code in the range (included). Needs to be after [[postalCodeBegin]].';
    public const LABEL = 'postalCodeEnd';
    public const NAME = 'schema:postalCodeEnd';
    public const VALUES = ['TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['PostalCodeRangeSpecification' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PostalCodeRangeSpecificationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2506'];
    public const SUPERSEDED_BY = null;
}
