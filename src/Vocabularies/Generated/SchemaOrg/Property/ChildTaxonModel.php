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

final class ChildTaxonModel
{
    public const DESCRIPTION = 'Closest child taxa of the taxon in question.';
    public const LABEL = 'childTaxon';
    public const NAME = 'schema:childTaxon';
    public const VALUES = ['TaxonModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TaxonModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel', 'URLModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\URLModel'];
    public const TYPES = ['Taxon' => 'Jolicode\Vocabularies\SchemaOrg\Type\TaxonModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
