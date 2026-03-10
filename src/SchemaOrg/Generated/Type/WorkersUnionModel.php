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

final class WorkersUnionModel
{
    public const DESCRIPTION = 'A Workers Union (also known as a Labor Union, Labour Union, or Trade Union) is an organization that promotes the interests of its worker members by collectively bargaining with management, organizing, and political lobbying.';
    public const LABEL = 'WorkersUnion';
    public const NAME = 'schema:WorkersUnion';
    public const PARENTS = ['OrganizationModel' => 'Jolicode\SchemaOrg\Type\OrganizationModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = [];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/243'];

    public function __construct(
        public ?Property\AcceptedPaymentMethodModel $acceptedPaymentMethod = null,
        public ?Property\ActionableFeedbackPolicyModel $actionableFeedbackPolicy = null,
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AddressModel $address = null,
        public ?Property\AgentInteractionStatisticModel $agentInteractionStatistic = null,
        public ?Property\AggregateRatingModel $aggregateRating = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\AlumniModel $alumni = null,
        public ?Property\AreaServedModel $areaServed = null,
        public ?Property\AwardModel $award = null,
        public ?Property\AwardsModel $awards = null,
        public ?Property\BrandModel $brand = null,
        public ?Property\CompanyRegistrationModel $companyRegistration = null,
        public ?Property\ContactPointModel $contactPoint = null,
        public ?Property\ContactPointsModel $contactPoints = null,
        public ?Property\CorrectionsPolicyModel $correctionsPolicy = null,
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
        public ?Property\GlobalLocationNumberModel $globalLocationNumber = null,
        public ?Property\HasCertificationModel $hasCertification = null,
        public ?Property\HasCredentialModel $hasCredential = null,
        public ?Property\HasGS1DigitalLinkModel $hasGS1DigitalLink = null,
        public ?Property\HasMemberProgramModel $hasMemberProgram = null,
        public ?Property\HasMerchantReturnPolicyModel $hasMerchantReturnPolicy = null,
        public ?Property\HasOfferCatalogModel $hasOfferCatalog = null,
        public ?Property\HasPOSModel $hasPOS = null,
        public ?Property\HasShippingServiceModel $hasShippingService = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\InteractionStatisticModel $interactionStatistic = null,
        public ?Property\IsicV4Model $isicV4 = null,
        public ?Property\Iso6523CodeModel $iso6523Code = null,
        public ?Property\KeywordsModel $keywords = null,
        public ?Property\KnowsAboutModel $knowsAbout = null,
        public ?Property\KnowsLanguageModel $knowsLanguage = null,
        public ?Property\LegalAddressModel $legalAddress = null,
        public ?Property\LegalNameModel $legalName = null,
        public ?Property\LegalRepresentativeModel $legalRepresentative = null,
        public ?Property\LeiCodeModel $leiCode = null,
        public ?Property\LocationModel $location = null,
        public ?Property\LogoModel $logo = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\MakesOfferModel $makesOffer = null,
        public ?Property\MemberModel $member = null,
        public ?Property\MemberOfModel $memberOf = null,
        public ?Property\MembersModel $members = null,
        public ?Property\NaicsModel $naics = null,
        public ?Property\NameModel $name = null,
        public ?Property\NonprofitStatusModel $nonprofitStatus = null,
        public ?Property\NumberOfEmployeesModel $numberOfEmployees = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\OwnershipFundingInfoModel $ownershipFundingInfo = null,
        public ?Property\OwnsModel $owns = null,
        public ?Property\ParentOrganizationModel $parentOrganization = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\PublishingPrinciplesModel $publishingPrinciples = null,
        public ?Property\ReviewModel $review = null,
        public ?Property\ReviewsModel $reviews = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SeeksModel $seeks = null,
        public ?Property\ServiceAreaModel $serviceArea = null,
        public ?Property\SkillsModel $skills = null,
        public ?Property\SloganModel $slogan = null,
        public ?Property\SponsorModel $sponsor = null,
        public ?Property\SubOrganizationModel $subOrganization = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\TaxIDModel $taxID = null,
        public ?Property\TelephoneModel $telephone = null,
        public ?Property\UnnamedSourcesPolicyModel $unnamedSourcesPolicy = null,
        public ?Property\UrlModel $url = null,
        public ?Property\VatIDModel $vatID = null,
    ) {
    }
}
