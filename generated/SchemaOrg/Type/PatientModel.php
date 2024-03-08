<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Type;

use SchemaOrg\Property;

final class PatientModel
{
    public const DESCRIPTION = 'A patient is any person recipient of health care services.';
    public const LABEL = 'Patient';
    public const NAME = 'schema:Patient';
    public const PARENTS = ['MedicalAudienceModel' => 'SchemaOrg\Type\MedicalAudienceModel', 'PersonModel' => 'SchemaOrg\Type\PersonModel'];
    public const ENUMERATION_MEMBERS = [];

    public function __construct(
        public ?Property\AdditionalNameModel $additionalName = null,
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AddressModel $address = null,
        public ?Property\AffiliationModel $affiliation = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\AlumniOfModel $alumniOf = null,
        public ?Property\AudienceTypeModel $audienceType = null,
        public ?Property\AwardModel $award = null,
        public ?Property\AwardsModel $awards = null,
        public ?Property\BirthDateModel $birthDate = null,
        public ?Property\BirthPlaceModel $birthPlace = null,
        public ?Property\BrandModel $brand = null,
        public ?Property\CallSignModel $callSign = null,
        public ?Property\ChildrenModel $children = null,
        public ?Property\ColleagueModel $colleague = null,
        public ?Property\ColleaguesModel $colleagues = null,
        public ?Property\ContactPointModel $contactPoint = null,
        public ?Property\ContactPointsModel $contactPoints = null,
        public ?Property\DeathDateModel $deathDate = null,
        public ?Property\DeathPlaceModel $deathPlace = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DiagnosisModel $diagnosis = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\DrugModel $drug = null,
        public ?Property\DunsModel $duns = null,
        public ?Property\EmailModel $email = null,
        public ?Property\FamilyNameModel $familyName = null,
        public ?Property\FaxNumberModel $faxNumber = null,
        public ?Property\FollowsModel $follows = null,
        public ?Property\FunderModel $funder = null,
        public ?Property\FundingModel $funding = null,
        public ?Property\GenderModel $gender = null,
        public ?Property\GeographicAreaModel $geographicArea = null,
        public ?Property\GivenNameModel $givenName = null,
        public ?Property\GlobalLocationNumberModel $globalLocationNumber = null,
        public ?Property\HasCredentialModel $hasCredential = null,
        public ?Property\HasOccupationModel $hasOccupation = null,
        public ?Property\HasOfferCatalogModel $hasOfferCatalog = null,
        public ?Property\HasPOSModel $hasPOS = null,
        public ?Property\HealthConditionModel $healthCondition = null,
        public ?Property\HeightModel $height = null,
        public ?Property\HomeLocationModel $homeLocation = null,
        public ?Property\HonorificPrefixModel $honorificPrefix = null,
        public ?Property\HonorificSuffixModel $honorificSuffix = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\InteractionStatisticModel $interactionStatistic = null,
        public ?Property\IsicV4Model $isicV4 = null,
        public ?Property\JobTitleModel $jobTitle = null,
        public ?Property\KnowsModel $knows = null,
        public ?Property\KnowsAboutModel $knowsAbout = null,
        public ?Property\KnowsLanguageModel $knowsLanguage = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\MakesOfferModel $makesOffer = null,
        public ?Property\MemberOfModel $memberOf = null,
        public ?Property\NaicsModel $naics = null,
        public ?Property\NameModel $name = null,
        public ?Property\NationalityModel $nationality = null,
        public ?Property\NetWorthModel $netWorth = null,
        public ?Property\OwnsModel $owns = null,
        public ?Property\ParentModel $parent = null,
        public ?Property\ParentsModel $parents = null,
        public ?Property\PerformerInModel $performerIn = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\PublishingPrinciplesModel $publishingPrinciples = null,
        public ?Property\RelatedToModel $relatedTo = null,
        public ?Property\RequiredGenderModel $requiredGender = null,
        public ?Property\RequiredMaxAgeModel $requiredMaxAge = null,
        public ?Property\RequiredMinAgeModel $requiredMinAge = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SeeksModel $seeks = null,
        public ?Property\SiblingModel $sibling = null,
        public ?Property\SiblingsModel $siblings = null,
        public ?Property\SponsorModel $sponsor = null,
        public ?Property\SpouseModel $spouse = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\SuggestedAgeModel $suggestedAge = null,
        public ?Property\SuggestedGenderModel $suggestedGender = null,
        public ?Property\SuggestedMaxAgeModel $suggestedMaxAge = null,
        public ?Property\SuggestedMeasurementModel $suggestedMeasurement = null,
        public ?Property\SuggestedMinAgeModel $suggestedMinAge = null,
        public ?Property\TaxIDModel $taxID = null,
        public ?Property\TelephoneModel $telephone = null,
        public ?Property\UrlModel $url = null,
        public ?Property\VatIDModel $vatID = null,
        public ?Property\WeightModel $weight = null,
        public ?Property\WorkLocationModel $workLocation = null,
        public ?Property\WorksForModel $worksFor = null,
    ) {
    }
}
