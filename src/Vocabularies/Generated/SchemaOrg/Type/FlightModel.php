<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Type;

use Jolicode\Vocabularies\SchemaOrg\Property;

final class FlightModel
{
    public const DESCRIPTION = 'An airline flight.';
    public const LABEL = 'Flight';
    public const NAME = 'schema:Flight';
    public const PARENTS = ['TripModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TripModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = [];
    public const SOURCE = [];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AircraftModel $aircraft = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\ArrivalAirportModel $arrivalAirport = null,
        public ?Property\ArrivalGateModel $arrivalGate = null,
        public ?Property\ArrivalTerminalModel $arrivalTerminal = null,
        public ?Property\ArrivalTimeModel $arrivalTime = null,
        public ?Property\BoardingPolicyModel $boardingPolicy = null,
        public ?Property\CarrierModel $carrier = null,
        public ?Property\DepartureAirportModel $departureAirport = null,
        public ?Property\DepartureGateModel $departureGate = null,
        public ?Property\DepartureTerminalModel $departureTerminal = null,
        public ?Property\DepartureTimeModel $departureTime = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\EstimatedFlightDurationModel $estimatedFlightDuration = null,
        public ?Property\FlightDistanceModel $flightDistance = null,
        public ?Property\FlightNumberModel $flightNumber = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\ItineraryModel $itinerary = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\MealServiceModel $mealService = null,
        public ?Property\NameModel $name = null,
        public ?Property\OffersModel $offers = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\PartOfTripModel $partOfTrip = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\ProviderModel $provider = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SellerModel $seller = null,
        public ?Property\SubTripModel $subTrip = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\TripOriginModel $tripOrigin = null,
        public ?Property\UrlModel $url = null,
        public ?Property\WebCheckinTimeModel $webCheckinTime = null,
    ) {
    }
}
