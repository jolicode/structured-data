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

final class PaymentChargeSpecificationModel
{
    public const DESCRIPTION = 'The costs of settling the payment using a particular payment method.';
    public const LABEL = 'PaymentChargeSpecification';
    public const NAME = 'schema:PaymentChargeSpecification';
    public const PARENTS = ['PriceSpecificationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PriceSpecificationModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = [];
    public const SOURCE = [];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\AppliesToDeliveryMethodModel $appliesToDeliveryMethod = null,
        public ?Property\AppliesToPaymentMethodModel $appliesToPaymentMethod = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\EligibleQuantityModel $eligibleQuantity = null,
        public ?Property\EligibleTransactionVolumeModel $eligibleTransactionVolume = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\MaxPriceModel $maxPrice = null,
        public ?Property\MembershipPointsEarnedModel $membershipPointsEarned = null,
        public ?Property\MinPriceModel $minPrice = null,
        public ?Property\NameModel $name = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\PriceModel $price = null,
        public ?Property\PriceCurrencyModel $priceCurrency = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UrlModel $url = null,
        public ?Property\ValidForMemberTierModel $validForMemberTier = null,
        public ?Property\ValidFromModel $validFrom = null,
        public ?Property\ValidThroughModel $validThrough = null,
        public ?Property\ValueAddedTaxIncludedModel $valueAddedTaxIncluded = null,
    ) {
    }
}
