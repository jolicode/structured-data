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

final class IncludesAttractionModel
{
    public const DESCRIPTION = 'Attraction located at destination.';
    public const LABEL = 'includesAttraction';
    public const NAME = 'schema:includesAttraction';
    public const VALUES = ['TouristAttractionModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TouristAttractionModel'];
    public const TYPES = ['TouristDestination' => 'Jolicode\Vocabularies\SchemaOrg\Type\TouristDestinationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
