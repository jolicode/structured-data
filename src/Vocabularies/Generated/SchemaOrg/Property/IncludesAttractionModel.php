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

final class IncludesAttractionModel
{
    public const DESCRIPTION = 'Attraction located at destination.';
    public const LABEL = 'includesAttraction';
    public const NAME = 'schema:includesAttraction';
    public const VALUES = ['TouristAttractionModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TouristAttractionModel'];
    public const TYPES = ['TouristDestination' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TouristDestinationModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1810'];
    public const SUPERSEDED_BY = null;
}
