<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class ChemicalCompositionModel
{
    public const DESCRIPTION = 'The chemical composition describes the identity and relative ratio of the chemical elements that make up the substance.';
    public const LABEL = 'chemicalComposition';
    public const NAME = 'schema:chemicalComposition';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['ChemicalSubstance' => 'SchemaOrg\Type\ChemicalSubstanceModel'];
}
