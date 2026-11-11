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

final class SubstanceOfConcernModel
{
    public const DESCRIPTION = 'A substance of concern (SoC) contained within the product, typically based on regulatory lists like REACH or RoHS.';
    public const LABEL = 'substanceOfConcern';
    public const NAME = 'schema:substanceOfConcern';
    public const VALUES = ['ChemicalSubstanceModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ChemicalSubstanceModel', 'DefinedTermModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DefinedTermModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel', 'URLModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\URLModel'];
    public const TYPES = ['Product' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ProductModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/DPP'];
    public const SUPERSEDED_BY = null;
}
