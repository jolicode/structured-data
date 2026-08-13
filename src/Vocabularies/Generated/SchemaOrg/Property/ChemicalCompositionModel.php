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

final class ChemicalCompositionModel
{
    public const DESCRIPTION = 'The chemical composition describes the identity and relative ratio of the chemical elements that make up the substance.';
    public const LABEL = 'chemicalComposition';
    public const NAME = 'schema:chemicalComposition';
    public const VALUES = ['TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['ChemicalSubstance' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ChemicalSubstanceModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['http://www.bioschemas.org/ChemicalSubstance'];
    public const SUPERSEDED_BY = null;
}
