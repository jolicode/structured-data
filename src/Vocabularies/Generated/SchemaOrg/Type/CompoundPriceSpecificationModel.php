<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type;

use JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class CompoundPriceSpecificationModel
{
    public const DESCRIPTION = 'A compound price specification is one that bundles multiple prices that all apply in combination for different dimensions of consumption. Use the name property of the attached unit price specification for indicating the dimension of a price component (e.g. "electricity" or "final cleaning").';
    public const LABEL = 'CompoundPriceSpecification';
    public const NAME = 'schema:CompoundPriceSpecification';
    public const PARENTS = ['PriceSpecificationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PriceSpecificationModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
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
        public ?Property\PriceComponentModel $priceComponent = null,
        public ?Property\PriceCurrencyModel $priceCurrency = null,
        public ?Property\PriceTypeModel $priceType = null,
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
