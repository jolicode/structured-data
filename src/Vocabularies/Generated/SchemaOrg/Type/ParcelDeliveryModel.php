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

final class ParcelDeliveryModel
{
    public const DESCRIPTION = 'The delivery of a parcel either via the postal service or a commercial service.';
    public const LABEL = 'ParcelDelivery';
    public const NAME = 'schema:ParcelDelivery';
    public const PARENTS = ['IntangibleModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\IntangibleModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\CarrierModel $carrier = null,
        public ?Property\DeliveryAddressModel $deliveryAddress = null,
        public ?Property\DeliveryStatusModel $deliveryStatus = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\ExpectedArrivalFromModel $expectedArrivalFrom = null,
        public ?Property\ExpectedArrivalUntilModel $expectedArrivalUntil = null,
        public ?Property\HasDeliveryMethodModel $hasDeliveryMethod = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\ItemShippedModel $itemShipped = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\OriginAddressModel $originAddress = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\PartOfOrderModel $partOfOrder = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\ProviderModel $provider = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\TrackingNumberModel $trackingNumber = null,
        public ?Property\TrackingUrlModel $trackingUrl = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
