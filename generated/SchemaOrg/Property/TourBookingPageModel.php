<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class TourBookingPageModel
{
    public const DESCRIPTION = 'A page providing information on how to book a tour of some [[Place]], such as an [[Accommodation]] or [[ApartmentComplex]] in a real estate setting, as well as other kinds of tours as appropriate.';
    public const LABEL = 'tourBookingPage';
    public const NAME = 'schema:tourBookingPage';
    public const VALUES = ['URLModel' => 'SchemaOrg\\Type\\URLModel'];
    public const TYPES = ['Accommodation' => 'SchemaOrg\\Type\\AccommodationModel', 'ApartmentComplex' => 'SchemaOrg\\Type\\ApartmentComplexModel', 'Place' => 'SchemaOrg\\Type\\PlaceModel'];
}
