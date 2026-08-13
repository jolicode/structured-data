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

final class RadioBroadcastServiceModel
{
    public const DESCRIPTION = 'A delivery service through which radio content is provided via broadcast over the air or online.';
    public const LABEL = 'RadioBroadcastService';
    public const NAME = 'schema:RadioBroadcastService';
    public const PARENTS = ['BroadcastServiceModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\BroadcastServiceModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2109'];
    public const SUPERSEDED_BY = null;

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AggregateRatingModel $aggregateRating = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\AreaModel $area = null,
        public ?Property\AreaServedModel $areaServed = null,
        public ?Property\AudienceModel $audience = null,
        public ?Property\AvailableChannelModel $availableChannel = null,
        public ?Property\AwardModel $award = null,
        public ?Property\BrandModel $brand = null,
        public ?Property\BroadcastAffiliateOfModel $broadcastAffiliateOf = null,
        public ?Property\BroadcastDisplayNameModel $broadcastDisplayName = null,
        public ?Property\BroadcastFrequencyModel $broadcastFrequency = null,
        public ?Property\BroadcastTimezoneModel $broadcastTimezone = null,
        public ?Property\BroadcasterModel $broadcaster = null,
        public ?Property\BrokerModel $broker = null,
        public ?Property\CallSignModel $callSign = null,
        public ?Property\CategoryModel $category = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\HasBroadcastChannelModel $hasBroadcastChannel = null,
        public ?Property\HasCertificationModel $hasCertification = null,
        public ?Property\HasOfferCatalogModel $hasOfferCatalog = null,
        public ?Property\HoursAvailableModel $hoursAvailable = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\InLanguageModel $inLanguage = null,
        public ?Property\IsRelatedToModel $isRelatedTo = null,
        public ?Property\IsSimilarToModel $isSimilarTo = null,
        public ?Property\LogoModel $logo = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\OffersModel $offers = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\ParentServiceModel $parentService = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\ProducesModel $produces = null,
        public ?Property\ProviderModel $provider = null,
        public ?Property\ProviderMobilityModel $providerMobility = null,
        public ?Property\ReviewModel $review = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\ServiceAreaModel $serviceArea = null,
        public ?Property\ServiceAudienceModel $serviceAudience = null,
        public ?Property\ServiceOutputModel $serviceOutput = null,
        public ?Property\ServiceTypeModel $serviceType = null,
        public ?Property\SloganModel $slogan = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\TermsOfServiceModel $termsOfService = null,
        public ?Property\UrlModel $url = null,
        public ?Property\VideoFormatModel $videoFormat = null,
    ) {
    }
}
