<?php

declare(strict_types=1);

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

final class UnitPriceSpecificationModel
{
    public const DESCRIPTION = 'The price asked for a given offer by the respective organization or person.';
    public const LABEL = 'UnitPriceSpecification';
    public const NAME = 'schema:UnitPriceSpecification';
    public const PARENTS = ['PriceSpecificationModel' => 'SchemaOrg\\Type\\PriceSpecificationModel'];
    public const ENUMERATION_MEMBERS = [];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\BillingDurationModel $billingDuration = null,
        public ?Property\BillingIncrementModel $billingIncrement = null,
        public ?Property\BillingStartModel $billingStart = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\EligibleQuantityModel $eligibleQuantity = null,
        public ?Property\EligibleTransactionVolumeModel $eligibleTransactionVolume = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\MaxPriceModel $maxPrice = null,
        public ?Property\MinPriceModel $minPrice = null,
        public ?Property\NameModel $name = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\PriceModel $price = null,
        public ?Property\PriceComponentTypeModel $priceComponentType = null,
        public ?Property\PriceCurrencyModel $priceCurrency = null,
        public ?Property\PriceTypeModel $priceType = null,
        public ?Property\ReferenceQuantityModel $referenceQuantity = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UnitCodeModel $unitCode = null,
        public ?Property\UnitTextModel $unitText = null,
        public ?Property\UrlModel $url = null,
        public ?Property\ValidFromModel $validFrom = null,
        public ?Property\ValidThroughModel $validThrough = null,
        public ?Property\ValueAddedTaxIncludedModel $valueAddedTaxIncluded = null,
    ) {
    }
}
