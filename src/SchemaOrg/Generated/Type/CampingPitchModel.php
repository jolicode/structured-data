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

final class CampingPitchModel
{
    public const DESCRIPTION = 'A [[CampingPitch]] is an individual place for overnight stay in the outdoors, typically being part of a larger camping site, or [[Campground]].\n\n
In British English a campsite, or campground, is an area, usually divided into a number of pitches, where people can camp overnight using tents or camper vans or caravans; this British English use of the word is synonymous with the American English expression campground. In American English the term campsite generally means an area where an individual, family, group, or military unit can pitch a tent or park a camper; a campground may contain many campsites.
(Source: Wikipedia, see [https://en.wikipedia.org/wiki/Campsite](https://en.wikipedia.org/wiki/Campsite).)\n\n
See also the dedicated [document on the use of schema.org for marking up hotels and other forms of accommodations](/docs/hotels.html).';
    public const LABEL = 'CampingPitch';
    public const NAME = 'schema:CampingPitch';
    public const PARENTS = ['AccommodationModel' => 'Jolicode\SchemaOrg\Type\AccommodationModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = [];
    public const SOURCE = [];

    public function __construct(
        public ?Property\AccommodationCategoryModel $accommodationCategory = null,
        public ?Property\AccommodationFloorPlanModel $accommodationFloorPlan = null,
        public ?Property\AdditionalPropertyModel $additionalProperty = null,
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AddressModel $address = null,
        public ?Property\AggregateRatingModel $aggregateRating = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\AmenityFeatureModel $amenityFeature = null,
        public ?Property\BedModel $bed = null,
        public ?Property\BranchCodeModel $branchCode = null,
        public ?Property\ContainedInModel $containedIn = null,
        public ?Property\ContainedInPlaceModel $containedInPlace = null,
        public ?Property\ContainsPlaceModel $containsPlace = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\EventModel $event = null,
        public ?Property\EventsModel $events = null,
        public ?Property\FaxNumberModel $faxNumber = null,
        public ?Property\FloorLevelModel $floorLevel = null,
        public ?Property\FloorSizeModel $floorSize = null,
        public ?Property\GeoModel $geo = null,
        public ?Property\GeoContainsModel $geoContains = null,
        public ?Property\GeoCoveredByModel $geoCoveredBy = null,
        public ?Property\GeoCoversModel $geoCovers = null,
        public ?Property\GeoCrossesModel $geoCrosses = null,
        public ?Property\GeoDisjointModel $geoDisjoint = null,
        public ?Property\GeoEqualsModel $geoEquals = null,
        public ?Property\GeoIntersectsModel $geoIntersects = null,
        public ?Property\GeoOverlapsModel $geoOverlaps = null,
        public ?Property\GeoTouchesModel $geoTouches = null,
        public ?Property\GeoWithinModel $geoWithin = null,
        public ?Property\GlobalLocationNumberModel $globalLocationNumber = null,
        public ?Property\HasCertificationModel $hasCertification = null,
        public ?Property\HasDriveThroughServiceModel $hasDriveThroughService = null,
        public ?Property\HasGS1DigitalLinkModel $hasGS1DigitalLink = null,
        public ?Property\HasMapModel $hasMap = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\IsAccessibleForFreeModel $isAccessibleForFree = null,
        public ?Property\IsicV4Model $isicV4 = null,
        public ?Property\KeywordsModel $keywords = null,
        public ?Property\LatitudeModel $latitude = null,
        public ?Property\LeaseLengthModel $leaseLength = null,
        public ?Property\LogoModel $logo = null,
        public ?Property\LongitudeModel $longitude = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\MapModel $map = null,
        public ?Property\MapsModel $maps = null,
        public ?Property\MaximumAttendeeCapacityModel $maximumAttendeeCapacity = null,
        public ?Property\NameModel $name = null,
        public ?Property\NumberOfBathroomsTotalModel $numberOfBathroomsTotal = null,
        public ?Property\NumberOfBedroomsModel $numberOfBedrooms = null,
        public ?Property\NumberOfFullBathroomsModel $numberOfFullBathrooms = null,
        public ?Property\NumberOfPartialBathroomsModel $numberOfPartialBathrooms = null,
        public ?Property\NumberOfRoomsModel $numberOfRooms = null,
        public ?Property\OccupancyModel $occupancy = null,
        public ?Property\OpeningHoursSpecificationModel $openingHoursSpecification = null,
        public ?Property\PermittedUsageModel $permittedUsage = null,
        public ?Property\PetsAllowedModel $petsAllowed = null,
        public ?Property\PhotoModel $photo = null,
        public ?Property\PhotosModel $photos = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\PublicAccessModel $publicAccess = null,
        public ?Property\ReviewModel $review = null,
        public ?Property\ReviewsModel $reviews = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SloganModel $slogan = null,
        public ?Property\SmokingAllowedModel $smokingAllowed = null,
        public ?Property\SpecialOpeningHoursSpecificationModel $specialOpeningHoursSpecification = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\TelephoneModel $telephone = null,
        public ?Property\TourBookingPageModel $tourBookingPage = null,
        public ?Property\UrlModel $url = null,
        public ?Property\YearBuiltModel $yearBuilt = null,
    ) {
    }
}
