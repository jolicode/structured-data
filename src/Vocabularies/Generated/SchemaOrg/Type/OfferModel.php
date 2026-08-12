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

final class OfferModel
{
    public const DESCRIPTION = 'An offer to transfer some rights to an item or to provide a service — for example, an offer to sell tickets to an event, to rent the DVD of a movie, to stream a TV show over the internet, to repair a motorcycle, or to loan a book.\n\nNote: As the [[businessFunction]] property, which identifies the form of offer (e.g. sell, lease, repair, dispose), defaults to http://purl.org/goodrelations/v1#Sell; an Offer without a defined businessFunction value can be assumed to be an offer to sell.\n\nFor [GTIN](http://www.gs1.org/barcodes/technical/idkeys/gtin)-related fields, see [Check Digit calculator](http://www.gs1.org/barcodes/support/check_digit_calculator) and [validation guide](http://www.gs1us.org/resources/standards/gtin-validation-guide) from [GS1](http://www.gs1.org/).';
    public const LABEL = 'Offer';
    public const NAME = 'schema:Offer';
    public const PARENTS = ['IntangibleModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\IntangibleModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;

    public function __construct(
        public ?Property\AcceptedPaymentMethodModel $acceptedPaymentMethod = null,
        public ?Property\AddOnModel $addOn = null,
        public ?Property\AdditionalPropertyModel $additionalProperty = null,
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
        public ?Property\HasGS1DigitalLinkModel $hasGS1DigitalLink = null,
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
        public ?Property\OwnerModel $owner = null,
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
        public ?Property\ValidForMemberTierModel $validForMemberTier = null,
        public ?Property\ValidFromModel $validFrom = null,
        public ?Property\ValidThroughModel $validThrough = null,
        public ?Property\WarrantyModel $warranty = null,
    ) {
    }
}
