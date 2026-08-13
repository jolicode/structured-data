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

final class MolecularFormulaModel
{
    public const DESCRIPTION = 'The empirical formula is the simplest whole number ratio of all the atoms in a molecule.';
    public const LABEL = 'molecularFormula';
    public const NAME = 'schema:molecularFormula';
    public const VALUES = ['TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['MolecularEntity' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MolecularEntityModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['http://www.bioschemas.org/MolecularEntity'];
    public const SUPERSEDED_BY = null;
}
