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

final class TaxonomicRangeModel
{
    public const DESCRIPTION = 'The taxonomic grouping of the organism that expresses, encodes, or in some way related to the BioChemEntity.';
    public const LABEL = 'taxonomicRange';
    public const NAME = 'schema:taxonomicRange';
    public const VALUES = ['DefinedTermModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DefinedTermModel', 'TaxonModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TaxonModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel', 'URLModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\URLModel'];
    public const TYPES = ['BioChemEntity' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\BioChemEntityModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['http://www.bioschemas.org'];
    public const SUPERSEDED_BY = null;
}
