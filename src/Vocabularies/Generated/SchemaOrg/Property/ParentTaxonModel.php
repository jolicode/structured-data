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

final class ParentTaxonModel
{
    public const DESCRIPTION = 'Closest parent taxon of the taxon in question.';
    public const LABEL = 'parentTaxon';
    public const NAME = 'schema:parentTaxon';
    public const VALUES = ['TaxonModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TaxonModel', 'TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel', 'URLModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\URLModel'];
    public const TYPES = ['Taxon' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TaxonModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['http://www.bioschemas.org/Taxon'];
    public const SUPERSEDED_BY = null;
}
