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

final class ExpressedInModel
{
    public const DESCRIPTION = 'Tissue, organ, biological sample, etc in which activity of this gene has been observed experimentally. For example brain, digestive system.';
    public const LABEL = 'expressedIn';
    public const NAME = 'schema:expressedIn';
    public const VALUES = ['AnatomicalStructureModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\AnatomicalStructureModel', 'AnatomicalSystemModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\AnatomicalSystemModel', 'BioChemEntityModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\BioChemEntityModel', 'DefinedTermModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DefinedTermModel'];
    public const TYPES = ['Gene' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\GeneModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['http://www.bioschemas.org/Gene'];
    public const SUPERSEDED_BY = null;
}
