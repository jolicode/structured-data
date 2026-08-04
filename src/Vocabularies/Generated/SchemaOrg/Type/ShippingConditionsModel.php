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

final class ShippingConditionsModel
{
    public const DESCRIPTION = 'ShippingConditions represent a set of constraints and information about the conditions of shipping a product. Such conditions may apply to only a subset of the products being shipped, depending on aspects of the product like weight, size, price, destination, and others. All the specified conditions must be met for this ShippingConditions to apply.';
    public const LABEL = 'ShippingConditions';
    public const NAME = 'schema:ShippingConditions';
    public const PARENTS = ['StructuredValueModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\StructuredValueModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/3617'];
    public const SUPERSEDED_BY = null;

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\DeliveryTimeModel $deliveryTime = null,
        public ?Property\DepthModel $depth = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\DoesNotShipModel $doesNotShip = null,
        public ?Property\HeightModel $height = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\IsUnlabelledFallbackModel $isUnlabelledFallback = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\NumItemsModel $numItems = null,
        public ?Property\OrderValueModel $orderValue = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SeasonalOverrideModel $seasonalOverride = null,
        public ?Property\ShippingDestinationModel $shippingDestination = null,
        public ?Property\ShippingOriginModel $shippingOrigin = null,
        public ?Property\ShippingRateModel $shippingRate = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\TransitTimeModel $transitTime = null,
        public ?Property\UrlModel $url = null,
        public ?Property\WeightModel $weight = null,
        public ?Property\WidthModel $width = null,
    ) {
    }
}
