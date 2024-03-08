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

final class BiologicalRoleModel
{
    public const DESCRIPTION = 'A role played by the BioChemEntity within a biological context.';
    public const LABEL = 'biologicalRole';
    public const NAME = 'schema:biologicalRole';
    public const VALUES = ['DefinedTermModel' => 'SchemaOrg\Type\DefinedTermModel'];
    public const TYPES = ['BioChemEntity' => 'SchemaOrg\Type\BioChemEntityModel'];
}
