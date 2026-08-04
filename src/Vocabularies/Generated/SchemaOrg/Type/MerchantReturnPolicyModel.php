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

final class MerchantReturnPolicyModel
{
    public const DESCRIPTION = 'A MerchantReturnPolicy provides information about product return policies associated with an [[Organization]], [[Product]], or [[Offer]].';
    public const LABEL = 'MerchantReturnPolicy';
    public const NAME = 'schema:MerchantReturnPolicy';
    public const PARENTS = ['IntangibleModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\IntangibleModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2288'];
    public const SUPERSEDED_BY = null;

    public function __construct(
        public ?Property\AdditionalPropertyModel $additionalProperty = null,
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\ApplicableCountryModel $applicableCountry = null,
        public ?Property\CustomerRemorseReturnFeesModel $customerRemorseReturnFees = null,
        public ?Property\CustomerRemorseReturnLabelSourceModel $customerRemorseReturnLabelSource = null,
        public ?Property\CustomerRemorseReturnShippingFeesAmountModel $customerRemorseReturnShippingFeesAmount = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\InStoreReturnsOfferedModel $inStoreReturnsOffered = null,
        public ?Property\ItemConditionModel $itemCondition = null,
        public ?Property\ItemDefectReturnFeesModel $itemDefectReturnFees = null,
        public ?Property\ItemDefectReturnLabelSourceModel $itemDefectReturnLabelSource = null,
        public ?Property\ItemDefectReturnShippingFeesAmountModel $itemDefectReturnShippingFeesAmount = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\MerchantReturnDaysModel $merchantReturnDays = null,
        public ?Property\MerchantReturnLinkModel $merchantReturnLink = null,
        public ?Property\NameModel $name = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\RefundTypeModel $refundType = null,
        public ?Property\RestockingFeeModel $restockingFee = null,
        public ?Property\ReturnFeesModel $returnFees = null,
        public ?Property\ReturnLabelSourceModel $returnLabelSource = null,
        public ?Property\ReturnMethodModel $returnMethod = null,
        public ?Property\ReturnPolicyCategoryModel $returnPolicyCategory = null,
        public ?Property\ReturnPolicyCountryModel $returnPolicyCountry = null,
        public ?Property\ReturnPolicySeasonalOverrideModel $returnPolicySeasonalOverride = null,
        public ?Property\ReturnShippingFeesAmountModel $returnShippingFeesAmount = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UrlModel $url = null,
        public ?Property\ValidForMemberTierModel $validForMemberTier = null,
    ) {
    }
}
