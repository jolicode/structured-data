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

final class BodyLocationModel
{
    public const DESCRIPTION = 'Location in the body of the anatomical structure.';
    public const LABEL = 'bodyLocation';
    public const NAME = 'schema:bodyLocation';
    public const VALUES = ['TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['AnatomicalStructure' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\AnatomicalStructureModel', 'MedicalProcedure' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MedicalProcedureModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
