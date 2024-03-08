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

final class HasMolecularFunctionModel
{
    public const DESCRIPTION = 'Molecular function performed by this BioChemEntity; please use PropertyValue if you want to include any evidence.';
    public const LABEL = 'hasMolecularFunction';
    public const NAME = 'schema:hasMolecularFunction';
    public const VALUES = ['DefinedTermModel' => 'SchemaOrg\Type\DefinedTermModel', 'PropertyValueModel' => 'SchemaOrg\Type\PropertyValueModel', 'URLModel' => 'SchemaOrg\Type\URLModel'];
    public const TYPES = ['BioChemEntity' => 'SchemaOrg\Type\BioChemEntityModel'];
}
