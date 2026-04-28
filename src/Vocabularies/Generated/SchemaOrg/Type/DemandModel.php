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

final class DemandModel
{
    public const DESCRIPTION = 'A demand entity represents the public, not necessarily binding, not necessarily exclusive, announcement by an organization or person to seek a certain type of goods or services. For describing demand using this type, the very same properties used for Offer apply.';
    public const LABEL = 'Demand';
    public const NAME = 'schema:Demand';
    public const PARENTS = ['IntangibleModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\IntangibleModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = [];
    public const SOURCE = [];

    public function __construct(
        public ?Property\AcceptedPaymentMethodModel $acceptedPaymentMethod = null,
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AdvanceBookingRequirementModel $advanceBookingRequirement = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\AreaServedModel $areaServed = null,
        public ?Property\AsinModel $asin = null,
        public ?Property\AvailabilityModel $availability = null,
        public ?Property\AvailabilityEndsModel $availabilityEnds = null,
        public ?Property\AvailabilityStartsModel $availabilityStarts = null,
        public ?Property\AvailableAtOrFromModel $availableAtOrFrom = null,
        public ?Property\AvailableDeliveryMethodModel $availableDeliveryMethod = null,
        public ?Property\BusinessFunctionModel $businessFunction = null,
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
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\IncludesObjectModel $includesObject = null,
        public ?Property\IneligibleRegionModel $ineligibleRegion = null,
        public ?Property\InventoryLevelModel $inventoryLevel = null,
        public ?Property\ItemConditionModel $itemCondition = null,
        public ?Property\ItemOfferedModel $itemOffered = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\MpnModel $mpn = null,
        public ?Property\NameModel $name = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\PriceSpecificationModel $priceSpecification = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SellerModel $seller = null,
        public ?Property\SerialNumberModel $serialNumber = null,
        public ?Property\SkuModel $sku = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UrlModel $url = null,
        public ?Property\ValidFromModel $validFrom = null,
        public ?Property\ValidThroughModel $validThrough = null,
        public ?Property\WarrantyModel $warranty = null,
    ) {
    }
}
