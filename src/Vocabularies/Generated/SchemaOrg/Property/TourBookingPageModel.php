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

final class TourBookingPageModel
{
    public const DESCRIPTION = 'A page providing information on how to book a tour of some [[Place]], such as an [[Accommodation]] or [[ApartmentComplex]] in a real estate setting, as well as other kinds of tours as appropriate.';
    public const LABEL = 'tourBookingPage';
    public const NAME = 'schema:tourBookingPage';
    public const VALUES = ['URLModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\URLModel'];
    public const TYPES = ['Accommodation' => 'Jolicode\Vocabularies\SchemaOrg\Type\AccommodationModel', 'ApartmentComplex' => 'Jolicode\Vocabularies\SchemaOrg\Type\ApartmentComplexModel', 'Place' => 'Jolicode\Vocabularies\SchemaOrg\Type\PlaceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
