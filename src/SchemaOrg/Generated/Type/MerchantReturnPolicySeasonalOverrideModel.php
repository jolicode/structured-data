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

final class MerchantReturnPolicySeasonalOverrideModel
{
    public const DESCRIPTION = 'A seasonal override of a return policy, for example used for holidays.';
    public const LABEL = 'MerchantReturnPolicySeasonalOverride';
    public const NAME = 'schema:MerchantReturnPolicySeasonalOverride';
    public const PARENTS = ['IntangibleModel' => 'Jolicode\SchemaOrg\Type\IntangibleModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2880'];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\EndDateModel $endDate = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\MerchantReturnDaysModel $merchantReturnDays = null,
        public ?Property\NameModel $name = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\RefundTypeModel $refundType = null,
        public ?Property\RestockingFeeModel $restockingFee = null,
        public ?Property\ReturnFeesModel $returnFees = null,
        public ?Property\ReturnMethodModel $returnMethod = null,
        public ?Property\ReturnPolicyCategoryModel $returnPolicyCategory = null,
        public ?Property\ReturnShippingFeesAmountModel $returnShippingFeesAmount = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\StartDateModel $startDate = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
