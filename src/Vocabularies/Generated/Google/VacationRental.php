<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\Google;

final class VacationRental
{
    public const NAME = 'VacationRental';
    public const SUPPORTED_TYPES = ['VacationRental'];
    public const VALUE = [];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/vacation-rental';
    public const SUBTYPE = null;
    public const HAS_SPECIAL_RULES = false;
    public const SPECIAL_RULE_KEYS = [];
    public const IS_CAROUSEL_ELIGIBLE = false;
    public const CAROUSEL_PROPERTIES = [];
    public const PROPERTIES = ['containsPlace' => ['name' => 'containsPlace', 'severity' => 'required', 'supportedTypes' => ['Accommodation'], 'properties' => ['occupancy' => ['name' => 'occupancy', 'severity' => 'required', 'supportedTypes' => ['QuantitativeValue'], 'properties' => ['value' => ['name' => 'value', 'severity' => 'required', 'supportedTypes' => ['Integer']]]], 'additionalType' => ['name' => 'additionalType', 'severity' => 'optional', 'supportedTypes' => ['Text']], 'numberOfBedrooms' => ['name' => 'numberOfBedrooms', 'severity' => 'optional', 'supportedTypes' => ['Integer']], 'numberOfBathroomsTotal' => ['name' => 'numberOfBathroomsTotal', 'severity' => 'optional', 'supportedTypes' => ['Number']], 'numberOfRooms' => ['name' => 'numberOfRooms', 'severity' => 'optional', 'supportedTypes' => ['Integer']]]], 'identifier' => ['name' => 'identifier', 'severity' => 'required', 'supportedTypes' => ['Text']], 'image' => ['name' => 'image', 'severity' => 'required', 'supportedTypes' => ['URL']], 'latitude' => ['name' => 'latitude', 'severity' => 'required', 'supportedTypes' => ['Number']], 'longitude' => ['name' => 'longitude', 'severity' => 'required', 'supportedTypes' => ['Number']], 'name' => ['name' => 'name', 'severity' => 'required', 'supportedTypes' => ['Text']], 'address' => ['name' => 'address', 'severity' => 'optional', 'supportedTypes' => ['PostalAddress'], 'properties' => ['addressCountry' => ['name' => 'addressCountry', 'severity' => 'optional', 'supportedTypes' => ['Text']], 'addressLocality' => ['name' => 'addressLocality', 'severity' => 'optional', 'supportedTypes' => ['Text']], 'addressRegion' => ['name' => 'addressRegion', 'severity' => 'optional', 'supportedTypes' => ['Text']], 'postalCode' => ['name' => 'postalCode', 'severity' => 'optional', 'supportedTypes' => ['Text']], 'streetAddress' => ['name' => 'streetAddress', 'severity' => 'optional', 'supportedTypes' => ['Text']]]], 'description' => ['name' => 'description', 'severity' => 'optional', 'supportedTypes' => ['Text']], 'aggregateRating' => ['name' => 'aggregateRating', 'severity' => 'optional', 'supportedTypes' => ['AggregateRating']], 'review' => ['name' => 'review', 'severity' => 'optional', 'supportedTypes' => ['Review']], 'brand' => ['name' => 'brand', 'severity' => 'optional', 'supportedTypes' => ['Brand']], 'additionalType' => ['name' => 'additionalType', 'severity' => 'optional', 'supportedTypes' => ['Text']], 'checkinTime' => ['name' => 'checkinTime', 'severity' => 'optional', 'supportedTypes' => ['Time']], 'checkoutTime' => ['name' => 'checkoutTime', 'severity' => 'optional', 'supportedTypes' => ['Time']], 'knowsLanguage' => ['name' => 'knowsLanguage', 'severity' => 'optional', 'supportedTypes' => ['Text']]];
}
