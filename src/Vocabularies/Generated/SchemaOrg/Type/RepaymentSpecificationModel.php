<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Type;

use Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class RepaymentSpecificationModel
{
    public const DESCRIPTION = 'A structured value representing repayment.';
    public const LABEL = 'RepaymentSpecification';
    public const NAME = 'schema:RepaymentSpecification';
    public const PARENTS = ['StructuredValueModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\StructuredValueModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1253'];
    public const SUPERSEDED_BY = null;

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\DownPaymentModel $downPayment = null,
        public ?Property\EarlyPrepaymentPenaltyModel $earlyPrepaymentPenalty = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\LoanPaymentAmountModel $loanPaymentAmount = null,
        public ?Property\LoanPaymentFrequencyModel $loanPaymentFrequency = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\NumberOfLoanPaymentsModel $numberOfLoanPayments = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
