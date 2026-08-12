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

final class PartOfTripModel
{
    public const DESCRIPTION = 'Identifies that this [[Trip]] is a subTrip of another Trip.  For example Day 1, Day 2, etc. of a multi-day trip.';
    public const LABEL = 'partOfTrip';
    public const NAME = 'schema:partOfTrip';
    public const VALUES = ['TripModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TripModel'];
    public const TYPES = ['Trip' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TripModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1810'];
    public const SUPERSEDED_BY = null;
}
