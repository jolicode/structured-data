<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class HasBioPolymerSequenceModel
{
    public const DESCRIPTION = 'A symbolic representation of a BioChemEntity. For example, a nucleotide sequence of a Gene or an amino acid sequence of a Protein.';
    public const LABEL = 'hasBioPolymerSequence';
    public const NAME = 'schema:hasBioPolymerSequence';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Gene' => 'Jolicode\SchemaOrg\Type\GeneModel', 'Protein' => 'Jolicode\SchemaOrg\Type\ProteinModel'];
}
