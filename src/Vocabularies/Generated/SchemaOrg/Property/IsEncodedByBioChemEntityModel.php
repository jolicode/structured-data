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

final class IsEncodedByBioChemEntityModel
{
    public const DESCRIPTION = 'Another BioChemEntity encoding by this one.';
    public const LABEL = 'isEncodedByBioChemEntity';
    public const NAME = 'schema:isEncodedByBioChemEntity';
    public const VALUES = ['GeneModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\GeneModel'];
    public const TYPES = ['BioChemEntity' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\BioChemEntityModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['http://www.bioschemas.org/Gene'];
    public const SUPERSEDED_BY = null;
}
