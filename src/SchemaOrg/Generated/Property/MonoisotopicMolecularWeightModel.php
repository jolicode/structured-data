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

final class MonoisotopicMolecularWeightModel
{
    public const DESCRIPTION = 'The monoisotopic mass is the sum of the masses of the atoms in a molecule using the unbound, ground-state, rest mass of the principal (most abundant) isotope for each element instead of the isotopic average mass. Please include the units in the form \'&lt;Number&gt; &lt;unit&gt;\', for example \'770.230488 g/mol\' or as \'&lt;QuantitativeValue&gt;.';
    public const LABEL = 'monoisotopicMolecularWeight';
    public const NAME = 'schema:monoisotopicMolecularWeight';
    public const VALUES = ['QuantitativeValueModel' => 'Jolicode\SchemaOrg\Type\QuantitativeValueModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['MolecularEntity' => 'Jolicode\SchemaOrg\Type\MolecularEntityModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
