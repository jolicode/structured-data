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

final class BusTripModel
{
    public const DESCRIPTION = 'A trip on a commercial bus line.';
    public const LABEL = 'BusTrip';
    public const NAME = 'schema:BusTrip';
    public const PARENTS = ['TripModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TripModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = [];
    public const SOURCE = [];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\ArrivalBusStopModel $arrivalBusStop = null,
        public ?Property\ArrivalTimeModel $arrivalTime = null,
        public ?Property\BusNameModel $busName = null,
        public ?Property\BusNumberModel $busNumber = null,
        public ?Property\DepartureBusStopModel $departureBusStop = null,
        public ?Property\DepartureTimeModel $departureTime = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\ItineraryModel $itinerary = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\OffersModel $offers = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\PartOfTripModel $partOfTrip = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\ProviderModel $provider = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubTripModel $subTrip = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\TripOriginModel $tripOrigin = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
