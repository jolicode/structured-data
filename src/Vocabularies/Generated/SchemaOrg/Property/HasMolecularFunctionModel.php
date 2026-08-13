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

final class HasMolecularFunctionModel
{
    public const DESCRIPTION = 'Molecular function performed by this BioChemEntity; please use PropertyValue if you want to include any evidence.';
    public const LABEL = 'hasMolecularFunction';
    public const NAME = 'schema:hasMolecularFunction';
    public const VALUES = ['DefinedTermModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DefinedTermModel', 'PropertyValueModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PropertyValueModel', 'URLModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\URLModel'];
    public const TYPES = ['BioChemEntity' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\BioChemEntityModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['http://www.bioschemas.org/BioChemEntity'];
    public const SUPERSEDED_BY = null;
}
