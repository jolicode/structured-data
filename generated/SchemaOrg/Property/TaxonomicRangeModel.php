<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class TaxonomicRangeModel
{
    public const DESCRIPTION = 'The taxonomic grouping of the organism that expresses, encodes, or in some way related to the BioChemEntity.';
    public const LABEL = 'taxonomicRange';
    public const NAME = 'schema:taxonomicRange';
    public const VALUES = ['DefinedTermModel' => 'SchemaOrg\\Type\\DefinedTermModel', 'TaxonModel' => 'SchemaOrg\\Type\\TaxonModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel', 'URLModel' => 'SchemaOrg\\Type\\URLModel'];
    public const TYPES = ['BioChemEntity' => 'SchemaOrg\\Type\\BioChemEntityModel'];
}
