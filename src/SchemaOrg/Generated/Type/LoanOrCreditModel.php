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

final class LoanOrCreditModel
{
    public const DESCRIPTION = 'A financial product for the loaning of an amount of money, or line of credit, under agreed terms and charges.';
    public const LABEL = 'LoanOrCredit';
    public const NAME = 'schema:LoanOrCredit';
    public const PARENTS = ['FinancialProductModel' => 'Jolicode\SchemaOrg\Type\FinancialProductModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = [];
    public const SOURCE = [];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AggregateRatingModel $aggregateRating = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\AmountModel $amount = null,
        public ?Property\AnnualPercentageRateModel $annualPercentageRate = null,
        public ?Property\AreaServedModel $areaServed = null,
        public ?Property\AudienceModel $audience = null,
        public ?Property\AvailableChannelModel $availableChannel = null,
        public ?Property\AwardModel $award = null,
        public ?Property\BrandModel $brand = null,
        public ?Property\BrokerModel $broker = null,
        public ?Property\CategoryModel $category = null,
        public ?Property\CurrencyModel $currency = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\FeesAndCommissionsSpecificationModel $feesAndCommissionsSpecification = null,
        public ?Property\GracePeriodModel $gracePeriod = null,
        public ?Property\HasCertificationModel $hasCertification = null,
        public ?Property\HasOfferCatalogModel $hasOfferCatalog = null,
        public ?Property\HoursAvailableModel $hoursAvailable = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\InterestRateModel $interestRate = null,
        public ?Property\IsRelatedToModel $isRelatedTo = null,
        public ?Property\IsSimilarToModel $isSimilarTo = null,
        public ?Property\LoanRepaymentFormModel $loanRepaymentForm = null,
        public ?Property\LoanTermModel $loanTerm = null,
        public ?Property\LoanTypeModel $loanType = null,
        public ?Property\LogoModel $logo = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\OffersModel $offers = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\ProducesModel $produces = null,
        public ?Property\ProviderModel $provider = null,
        public ?Property\ProviderMobilityModel $providerMobility = null,
        public ?Property\RecourseLoanModel $recourseLoan = null,
        public ?Property\RenegotiableLoanModel $renegotiableLoan = null,
        public ?Property\RequiredCollateralModel $requiredCollateral = null,
        public ?Property\ReviewModel $review = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\ServiceAreaModel $serviceArea = null,
        public ?Property\ServiceAudienceModel $serviceAudience = null,
        public ?Property\ServiceOutputModel $serviceOutput = null,
        public ?Property\ServiceTypeModel $serviceType = null,
        public ?Property\SloganModel $slogan = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\TermsOfServiceModel $termsOfService = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
