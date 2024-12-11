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

final class PotentialUseModel
{
    public const DESCRIPTION = 'Intended use of the BioChemEntity by humans.';
    public const LABEL = 'potentialUse';
    public const NAME = 'schema:potentialUse';
    public const VALUES = ['DefinedTermModel' => 'Jolicode\SchemaOrg\Type\DefinedTermModel'];
    public const TYPES = ['ChemicalSubstance' => 'Jolicode\SchemaOrg\Type\ChemicalSubstanceModel', 'MolecularEntity' => 'Jolicode\SchemaOrg\Type\MolecularEntityModel'];
}
