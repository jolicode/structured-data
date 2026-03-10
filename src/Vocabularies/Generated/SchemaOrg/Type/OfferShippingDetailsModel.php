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

final class OfferShippingDetailsModel
{
    public const DESCRIPTION = 'OfferShippingDetails represents information about shipping destinations.

Multiple of these entities can be used to represent different shipping rates for different destinations:

One entity for Alaska/Hawaii. A different one for continental US. A different one for all France.

Multiple of these entities can be used to represent different shipping costs and delivery times.

Two entities that are identical but differ in rate and time:

E.g. Cheaper and slower: $5 in 5-7 days
or Fast and expensive: $15 in 1-2 days.';
    public const LABEL = 'OfferShippingDetails';
    public const NAME = 'schema:OfferShippingDetails';
    public const PARENTS = ['StructuredValueModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\StructuredValueModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = [];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2506'];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\DeliveryTimeModel $deliveryTime = null,
        public ?Property\DepthModel $depth = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\DoesNotShipModel $doesNotShip = null,
        public ?Property\HasShippingServiceModel $hasShippingService = null,
        public ?Property\HeightModel $height = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\ShippingDestinationModel $shippingDestination = null,
        public ?Property\ShippingOriginModel $shippingOrigin = null,
        public ?Property\ShippingRateModel $shippingRate = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UrlModel $url = null,
        public ?Property\ValidForMemberTierModel $validForMemberTier = null,
        public ?Property\WeightModel $weight = null,
        public ?Property\WidthModel $width = null,
    ) {
    }
}
