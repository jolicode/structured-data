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

final class CampgroundModel
{
    public const DESCRIPTION = 'A camping site, campsite, or [[Campground]] is a place used for overnight stay in the outdoors, typically containing individual [[CampingPitch]] locations. \n\n
In British English a campsite is an area, usually divided into a number of pitches, where people can camp overnight using tents or camper vans or caravans; this British English use of the word is synonymous with the American English expression campground. In American English the term campsite generally means an area where an individual, family, group, or military unit can pitch a tent or park a camper; a campground may contain many campsites (source: Wikipedia, see [https://en.wikipedia.org/wiki/Campsite](https://en.wikipedia.org/wiki/Campsite)).\n\n

See also the dedicated [document on the use of schema.org for marking up hotels and other forms of accommodations](/docs/hotels.html).
';
    public const LABEL = 'Campground';
    public const NAME = 'schema:Campground';
    public const PARENTS = ['CivicStructureModel' => 'Jolicode\SchemaOrg\Type\CivicStructureModel', 'LodgingBusinessModel' => 'Jolicode\SchemaOrg\Type\LodgingBusinessModel'];
    public const ENUMERATION_MEMBERS = [];

    public function __construct(
        public ?Property\ActionableFeedbackPolicyModel $actionableFeedbackPolicy = null,
        public ?Property\AdditionalPropertyModel $additionalProperty = null,
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AddressModel $address = null,
        public ?Property\AggregateRatingModel $aggregateRating = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\AlumniModel $alumni = null,
        public ?Property\AmenityFeatureModel $amenityFeature = null,
        public ?Property\AreaServedModel $areaServed = null,
        public ?Property\AudienceModel $audience = null,
        public ?Property\AvailableLanguageModel $availableLanguage = null,
        public ?Property\AwardModel $award = null,
        public ?Property\AwardsModel $awards = null,
        public ?Property\BranchCodeModel $branchCode = null,
        public ?Property\BranchOfModel $branchOf = null,
        public ?Property\BrandModel $brand = null,
        public ?Property\CheckinTimeModel $checkinTime = null,
        public ?Property\CheckoutTimeModel $checkoutTime = null,
        public ?Property\ContactPointModel $contactPoint = null,
        public ?Property\ContactPointsModel $contactPoints = null,
        public ?Property\ContainedInModel $containedIn = null,
        public ?Property\ContainedInPlaceModel $containedInPlace = null,
        public ?Property\ContainsPlaceModel $containsPlace = null,
        public ?Property\CorrectionsPolicyModel $correctionsPolicy = null,
        public ?Property\CurrenciesAcceptedModel $currenciesAccepted = null,
        public ?Property\DepartmentModel $department = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\DissolutionDateModel $dissolutionDate = null,
        public ?Property\DiversityPolicyModel $diversityPolicy = null,
        public ?Property\DiversityStaffingReportModel $diversityStaffingReport = null,
        public ?Property\DunsModel $duns = null,
        public ?Property\EmailModel $email = null,
        public ?Property\EmployeeModel $employee = null,
        public ?Property\EmployeesModel $employees = null,
        public ?Property\EthicsPolicyModel $ethicsPolicy = null,
        public ?Property\EventModel $event = null,
        public ?Property\EventsModel $events = null,
        public ?Property\FaxNumberModel $faxNumber = null,
        public ?Property\FounderModel $founder = null,
        public ?Property\FoundersModel $founders = null,
        public ?Property\FoundingDateModel $foundingDate = null,
        public ?Property\FoundingLocationModel $foundingLocation = null,
        public ?Property\FunderModel $funder = null,
        public ?Property\FundingModel $funding = null,
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
        public ?Property\HasCredentialModel $hasCredential = null,
        public ?Property\HasDriveThroughServiceModel $hasDriveThroughService = null,
        public ?Property\HasMapModel $hasMap = null,
        public ?Property\HasMerchantReturnPolicyModel $hasMerchantReturnPolicy = null,
        public ?Property\HasOfferCatalogModel $hasOfferCatalog = null,
        public ?Property\HasPOSModel $hasPOS = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\InteractionStatisticModel $interactionStatistic = null,
        public ?Property\IsAccessibleForFreeModel $isAccessibleForFree = null,
        public ?Property\IsicV4Model $isicV4 = null,
        public ?Property\Iso6523CodeModel $iso6523Code = null,
        public ?Property\KeywordsModel $keywords = null,
        public ?Property\KnowsAboutModel $knowsAbout = null,
        public ?Property\KnowsLanguageModel $knowsLanguage = null,
        public ?Property\LatitudeModel $latitude = null,
        public ?Property\LegalNameModel $legalName = null,
        public ?Property\LeiCodeModel $leiCode = null,
        public ?Property\LocationModel $location = null,
        public ?Property\LogoModel $logo = null,
        public ?Property\LongitudeModel $longitude = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\MakesOfferModel $makesOffer = null,
        public ?Property\MapModel $map = null,
        public ?Property\MapsModel $maps = null,
        public ?Property\MaximumAttendeeCapacityModel $maximumAttendeeCapacity = null,
        public ?Property\MemberModel $member = null,
        public ?Property\MemberOfModel $memberOf = null,
        public ?Property\MembersModel $members = null,
        public ?Property\NaicsModel $naics = null,
        public ?Property\NameModel $name = null,
        public ?Property\NonprofitStatusModel $nonprofitStatus = null,
        public ?Property\NumberOfEmployeesModel $numberOfEmployees = null,
        public ?Property\NumberOfRoomsModel $numberOfRooms = null,
        public ?Property\OpeningHoursModel $openingHours = null,
        public ?Property\OpeningHoursSpecificationModel $openingHoursSpecification = null,
        public ?Property\OwnershipFundingInfoModel $ownershipFundingInfo = null,
        public ?Property\OwnsModel $owns = null,
        public ?Property\ParentOrganizationModel $parentOrganization = null,
        public ?Property\PaymentAcceptedModel $paymentAccepted = null,
        public ?Property\PetsAllowedModel $petsAllowed = null,
        public ?Property\PhotoModel $photo = null,
        public ?Property\PhotosModel $photos = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\PriceRangeModel $priceRange = null,
        public ?Property\PublicAccessModel $publicAccess = null,
        public ?Property\PublishingPrinciplesModel $publishingPrinciples = null,
        public ?Property\ReviewModel $review = null,
        public ?Property\ReviewsModel $reviews = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SeeksModel $seeks = null,
        public ?Property\ServiceAreaModel $serviceArea = null,
        public ?Property\SloganModel $slogan = null,
        public ?Property\SmokingAllowedModel $smokingAllowed = null,
        public ?Property\SpecialOpeningHoursSpecificationModel $specialOpeningHoursSpecification = null,
        public ?Property\SponsorModel $sponsor = null,
        public ?Property\StarRatingModel $starRating = null,
        public ?Property\SubOrganizationModel $subOrganization = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\TaxIDModel $taxID = null,
        public ?Property\TelephoneModel $telephone = null,
        public ?Property\TourBookingPageModel $tourBookingPage = null,
        public ?Property\UnnamedSourcesPolicyModel $unnamedSourcesPolicy = null,
        public ?Property\UrlModel $url = null,
        public ?Property\VatIDModel $vatID = null,
    ) {
    }
}
