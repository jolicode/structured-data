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

final class SmilesModel
{
    public const DESCRIPTION = 'A specification in form of a line notation for describing the structure of chemical species using short ASCII strings.  Double bond stereochemistry \ indicators may need to be escaped in the string in formats where the backslash is an escape character.';
    public const LABEL = 'smiles';
    public const NAME = 'schema:smiles';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['MolecularEntity' => 'Jolicode\Vocabularies\SchemaOrg\Type\MolecularEntityModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
