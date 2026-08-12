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

final class CodingSystemModel
{
    public const DESCRIPTION = 'The coding system, e.g. \'ICD-10\'.';
    public const LABEL = 'codingSystem';
    public const NAME = 'schema:codingSystem';
    public const VALUES = ['TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['MedicalCode' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MedicalCodeModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
