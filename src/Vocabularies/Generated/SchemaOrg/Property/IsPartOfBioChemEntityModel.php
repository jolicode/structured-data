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

final class IsPartOfBioChemEntityModel
{
    public const DESCRIPTION = 'Indicates a BioChemEntity that is (in some sense) a part of this BioChemEntity.';
    public const LABEL = 'isPartOfBioChemEntity';
    public const NAME = 'schema:isPartOfBioChemEntity';
    public const VALUES = ['BioChemEntityModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\BioChemEntityModel'];
    public const TYPES = ['BioChemEntity' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\BioChemEntityModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['http://www.bioschemas.org'];
    public const SUPERSEDED_BY = null;
}
