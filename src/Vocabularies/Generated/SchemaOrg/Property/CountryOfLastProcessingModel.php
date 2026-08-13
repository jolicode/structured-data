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

final class CountryOfLastProcessingModel
{
    public const DESCRIPTION = 'The place where the item (typically [[Product]]) was last processed and tested before importation.';
    public const LABEL = 'countryOfLastProcessing';
    public const NAME = 'schema:countryOfLastProcessing';
    public const VALUES = ['TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Product' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ProductModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/991'];
    public const SUPERSEDED_BY = null;
}
