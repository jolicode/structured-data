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

final class TouristDestinationModel
{
    public const DESCRIPTION = 'A tourist destination. In principle any [[Place]] can be a [[TouristDestination]] from a [[City]], Region or [[Country]] to an [[AmusementPark]] or [[Hotel]]. This Type can be used on its own to describe a general [[TouristDestination]], or be used as an [[additionalType]] to add tourist relevant properties to any other [[Place]].  A [[TouristDestination]] is defined as a [[Place]] that contains, or is colocated with, one or more [[TouristAttraction]]s, often linked by a similar theme or interest to a particular [[touristType]]. The [UNWTO](http://www2.unwto.org/) defines Destination (main destination of a tourism trip) as the place visited that is central to the decision to take the trip.
  (See examples below.)';
    public const LABEL = 'TouristDestination';
    public const NAME = 'schema:TouristDestination';
    public const PARENTS = ['PlaceModel' => 'Jolicode\SchemaOrg\Type\PlaceModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1810'];

    public function __construct(
        public ?Property\AdditionalPropertyModel $additionalProperty = null,
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AddressModel $address = null,
        public ?Property\AggregateRatingModel $aggregateRating = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\AmenityFeatureModel $amenityFeature = null,
        public ?Property\BranchCodeModel $branchCode = null,
        public ?Property\ContainedInModel $containedIn = null,
        public ?Property\ContainedInPlaceModel $containedInPlace = null,
        public ?Property\ContainsPlaceModel $containsPlace = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\EventModel $event = null,
        public ?Property\EventsModel $events = null,
        public ?Property\FaxNumberModel $faxNumber = null,
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
        public ?Property\IncludesAttractionModel $includesAttraction = null,
        public ?Property\IsAccessibleForFreeModel $isAccessibleForFree = null,
        public ?Property\IsicV4Model $isicV4 = null,
        public ?Property\KeywordsModel $keywords = null,
        public ?Property\LatitudeModel $latitude = null,
        public ?Property\LogoModel $logo = null,
        public ?Property\LongitudeModel $longitude = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\MapModel $map = null,
        public ?Property\MapsModel $maps = null,
        public ?Property\MaximumAttendeeCapacityModel $maximumAttendeeCapacity = null,
        public ?Property\NameModel $name = null,
        public ?Property\OpeningHoursSpecificationModel $openingHoursSpecification = null,
        public ?Property\OwnerModel $owner = null,
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
        public ?Property\TouristTypeModel $touristType = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
