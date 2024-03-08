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

final class OfferForPurchaseModel
{
    public const DESCRIPTION = 'An [[OfferForPurchase]] in Schema.org represents an [[Offer]] to sell something, i.e. an [[Offer]] whose
  [[businessFunction]] is [sell](http://purl.org/goodrelations/v1#Sell.). See [Good Relations](https://en.wikipedia.org/wiki/GoodRelations) for
  background on the underlying concepts.
  ';
    public const LABEL = 'OfferForPurchase';
    public const NAME = 'schema:OfferForPurchase';
    public const PARENTS = ['OfferModel' => 'SchemaOrg\Type\OfferModel'];
    public const ENUMERATION_MEMBERS = [];

    public function __construct(
        public ?Property\AcceptedPaymentMethodModel $acceptedPaymentMethod = null,
        public ?Property\AddOnModel $addOn = null,
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AdvanceBookingRequirementModel $advanceBookingRequirement = null,
        public ?Property\AggregateRatingModel $aggregateRating = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\AreaServedModel $areaServed = null,
        public ?Property\AsinModel $asin = null,
        public ?Property\AvailabilityModel $availability = null,
        public ?Property\AvailabilityEndsModel $availabilityEnds = null,
        public ?Property\AvailabilityStartsModel $availabilityStarts = null,
        public ?Property\AvailableAtOrFromModel $availableAtOrFrom = null,
        public ?Property\AvailableDeliveryMethodModel $availableDeliveryMethod = null,
        public ?Property\BusinessFunctionModel $businessFunction = null,
        public ?Property\CategoryModel $category = null,
        public ?Property\CheckoutPageURLTemplateModel $checkoutPageURLTemplate = null,
        public ?Property\DeliveryLeadTimeModel $deliveryLeadTime = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\EligibleCustomerTypeModel $eligibleCustomerType = null,
        public ?Property\EligibleDurationModel $eligibleDuration = null,
        public ?Property\EligibleQuantityModel $eligibleQuantity = null,
        public ?Property\EligibleRegionModel $eligibleRegion = null,
        public ?Property\EligibleTransactionVolumeModel $eligibleTransactionVolume = null,
        public ?Property\GtinModel $gtin = null,
        public ?Property\Gtin12Model $gtin12 = null,
        public ?Property\Gtin13Model $gtin13 = null,
        public ?Property\Gtin14Model $gtin14 = null,
        public ?Property\Gtin8Model $gtin8 = null,
        public ?Property\HasAdultConsiderationModel $hasAdultConsideration = null,
        public ?Property\HasMeasurementModel $hasMeasurement = null,
        public ?Property\HasMerchantReturnPolicyModel $hasMerchantReturnPolicy = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\IncludesObjectModel $includesObject = null,
        public ?Property\IneligibleRegionModel $ineligibleRegion = null,
        public ?Property\InventoryLevelModel $inventoryLevel = null,
        public ?Property\IsFamilyFriendlyModel $isFamilyFriendly = null,
        public ?Property\ItemConditionModel $itemCondition = null,
        public ?Property\ItemOfferedModel $itemOffered = null,
        public ?Property\LeaseLengthModel $leaseLength = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\MobileUrlModel $mobileUrl = null,
        public ?Property\MpnModel $mpn = null,
        public ?Property\NameModel $name = null,
        public ?Property\OfferedByModel $offeredBy = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\PriceModel $price = null,
        public ?Property\PriceCurrencyModel $priceCurrency = null,
        public ?Property\PriceSpecificationModel $priceSpecification = null,
        public ?Property\PriceValidUntilModel $priceValidUntil = null,
        public ?Property\ReviewModel $review = null,
        public ?Property\ReviewsModel $reviews = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SellerModel $seller = null,
        public ?Property\SerialNumberModel $serialNumber = null,
        public ?Property\ShippingDetailsModel $shippingDetails = null,
        public ?Property\SkuModel $sku = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UrlModel $url = null,
        public ?Property\ValidFromModel $validFrom = null,
        public ?Property\ValidThroughModel $validThrough = null,
        public ?Property\WarrantyModel $warranty = null,
    ) {
    }
}
