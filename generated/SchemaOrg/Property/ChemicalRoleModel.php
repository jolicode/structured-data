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

final class ChemicalRoleModel
{
    public const DESCRIPTION = 'A role played by the BioChemEntity within a chemical context.';
    public const LABEL = 'chemicalRole';
    public const NAME = 'schema:chemicalRole';
    public const VALUES = ['DefinedTermModel' => 'SchemaOrg\\Type\\DefinedTermModel'];
    public const TYPES = ['ChemicalSubstance' => 'SchemaOrg\\Type\\ChemicalSubstanceModel', 'MolecularEntity' => 'SchemaOrg\\Type\\MolecularEntityModel'];
}
