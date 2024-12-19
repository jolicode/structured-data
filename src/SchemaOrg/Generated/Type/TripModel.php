<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Type;

use Jolicode\SchemaOrg\Property;

final class TripModel
{
    public const DESCRIPTION = 'A trip or journey. An itinerary of visits to one or more places.';
    public const LABEL = 'Trip';
    public const NAME = 'schema:Trip';
    public const PARENTS = ['IntangibleModel' => 'Jolicode\SchemaOrg\Type\IntangibleModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = [];
    public const SOURCE = [];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\ArrivalTimeModel $arrivalTime = null,
        public ?Property\DepartureTimeModel $departureTime = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\ItineraryModel $itinerary = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\OffersModel $offers = null,
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
