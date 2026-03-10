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

final class BeachModel
{
    public const DESCRIPTION = 'Beach.';
    public const LABEL = 'Beach';
    public const NAME = 'schema:Beach';
    public const PARENTS = ['CivicStructureModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\CivicStructureModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = [];
    public const SOURCE = [];

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
        public ?Property\OpeningHoursModel $openingHours = null,
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
        public ?Property\UrlModel $url = null,
    ) {
    }
}
