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

final class PartOfSystemModel
{
    public const DESCRIPTION = 'The anatomical or organ system that this structure is part of.';
    public const LABEL = 'partOfSystem';
    public const NAME = 'schema:partOfSystem';
    public const VALUES = ['AnatomicalSystemModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\AnatomicalSystemModel'];
    public const TYPES = ['AnatomicalStructure' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\AnatomicalStructureModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
