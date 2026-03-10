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

final class HasRepresentationModel
{
    public const DESCRIPTION = 'A common representation such as a protein sequence or chemical structure for this entity. For images use schema.org/image.';
    public const LABEL = 'hasRepresentation';
    public const NAME = 'schema:hasRepresentation';
    public const VALUES = ['PropertyValueModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PropertyValueModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel', 'URLModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\URLModel'];
    public const TYPES = ['BioChemEntity' => 'Jolicode\Vocabularies\SchemaOrg\Type\BioChemEntityModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
