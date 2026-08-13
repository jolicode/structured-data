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

final class TourBookingPageModel
{
    public const DESCRIPTION = 'A page providing information on how to book a tour of some [[Place]], such as an [[Accommodation]] or [[ApartmentComplex]] in a real estate setting, as well as other kinds of tours as appropriate.';
    public const LABEL = 'tourBookingPage';
    public const NAME = 'schema:tourBookingPage';
    public const VALUES = ['URLModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\URLModel'];
    public const TYPES = ['Accommodation' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\AccommodationModel', 'ApartmentComplex' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ApartmentComplexModel', 'Place' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PlaceModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2373'];
    public const SUPERSEDED_BY = null;
}
