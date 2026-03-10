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

final class TaxonRankModel
{
    public const DESCRIPTION = 'The taxonomic rank of this taxon given preferably as a URI from a controlled vocabulary – typically the ranks from TDWG TaxonRank ontology or equivalent Wikidata URIs.';
    public const LABEL = 'taxonRank';
    public const NAME = 'schema:taxonRank';
    public const VALUES = ['PropertyValueModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PropertyValueModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel', 'URLModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\URLModel'];
    public const TYPES = ['Taxon' => 'Jolicode\Vocabularies\SchemaOrg\Type\TaxonModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
