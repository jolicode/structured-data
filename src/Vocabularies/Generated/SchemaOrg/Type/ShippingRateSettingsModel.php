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

final class ShippingRateSettingsModel
{
    public const DESCRIPTION = 'A ShippingRateSettings represents re-usable pieces of shipping information. It is designed for publication on an URL that may be referenced via the [[shippingSettingsLink]] property of an [[OfferShippingDetails]]. Several occurrences can be published, distinguished and matched (i.e. identified/referenced) by their different values for [[shippingLabel]].';
    public const LABEL = 'ShippingRateSettings';
    public const NAME = 'schema:ShippingRateSettings';
    public const PARENTS = ['StructuredValueModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\StructuredValueModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = [];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2506'];
    public const SUPERSEDED_BY = null;

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\DoesNotShipModel $doesNotShip = null,
        public ?Property\FreeShippingThresholdModel $freeShippingThreshold = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\IsUnlabelledFallbackModel $isUnlabelledFallback = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\OrderPercentageModel $orderPercentage = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\ShippingDestinationModel $shippingDestination = null,
        public ?Property\ShippingRateModel $shippingRate = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UrlModel $url = null,
        public ?Property\WeightPercentageModel $weightPercentage = null,
    ) {
    }
}
