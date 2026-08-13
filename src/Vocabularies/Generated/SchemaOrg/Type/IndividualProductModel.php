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

final class IndividualProductModel
{
    public const DESCRIPTION = 'A single, identifiable product instance (e.g. a laptop with a particular serial number).';
    public const LABEL = 'IndividualProduct';
    public const NAME = 'schema:IndividualProduct';
    public const PARENTS = ['ProductModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ProductModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;

    public function __construct(
        public ?Property\AdditionalPropertyModel $additionalProperty = null,
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AggregateRatingModel $aggregateRating = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\AsinModel $asin = null,
        public ?Property\AudienceModel $audience = null,
        public ?Property\AwardModel $award = null,
        public ?Property\AwardsModel $awards = null,
        public ?Property\BrandModel $brand = null,
        public ?Property\CategoryModel $category = null,
        public ?Property\ColorModel $color = null,
        public ?Property\ColorSwatchModel $colorSwatch = null,
        public ?Property\CountryOfAssemblyModel $countryOfAssembly = null,
        public ?Property\CountryOfLastProcessingModel $countryOfLastProcessing = null,
        public ?Property\CountryOfOriginModel $countryOfOrigin = null,
        public ?Property\DepthModel $depth = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\DisplayLocationModel $displayLocation = null,
        public ?Property\FundingModel $funding = null,
        public ?Property\GtinModel $gtin = null,
        public ?Property\Gtin12Model $gtin12 = null,
        public ?Property\Gtin13Model $gtin13 = null,
        public ?Property\Gtin14Model $gtin14 = null,
        public ?Property\Gtin8Model $gtin8 = null,
        public ?Property\HasAdultConsiderationModel $hasAdultConsideration = null,
        public ?Property\HasCertificationModel $hasCertification = null,
        public ?Property\HasEnergyConsumptionDetailsModel $hasEnergyConsumptionDetails = null,
        public ?Property\HasGS1DigitalLinkModel $hasGS1DigitalLink = null,
        public ?Property\HasMeasurementModel $hasMeasurement = null,
        public ?Property\HasMerchantReturnPolicyModel $hasMerchantReturnPolicy = null,
        public ?Property\HeightModel $height = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\InProductGroupWithIDModel $inProductGroupWithID = null,
        public ?Property\IsAccessoryOrSparePartForModel $isAccessoryOrSparePartFor = null,
        public ?Property\IsConsumableForModel $isConsumableFor = null,
        public ?Property\IsFamilyFriendlyModel $isFamilyFriendly = null,
        public ?Property\IsRelatedToModel $isRelatedTo = null,
        public ?Property\IsSimilarToModel $isSimilarTo = null,
        public ?Property\IsVariantOfModel $isVariantOf = null,
        public ?Property\ItemConditionModel $itemCondition = null,
        public ?Property\KeywordsModel $keywords = null,
        public ?Property\LogoModel $logo = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\ManufacturerModel $manufacturer = null,
        public ?Property\MaterialModel $material = null,
        public ?Property\MobileUrlModel $mobileUrl = null,
        public ?Property\ModelModel $model = null,
        public ?Property\MpnModel $mpn = null,
        public ?Property\NameModel $name = null,
        public ?Property\NegativeNotesModel $negativeNotes = null,
        public ?Property\NsnModel $nsn = null,
        public ?Property\OffersModel $offers = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\PatternModel $pattern = null,
        public ?Property\PositiveNotesModel $positiveNotes = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\ProductIDModel $productID = null,
        public ?Property\ProductionDateModel $productionDate = null,
        public ?Property\PurchaseDateModel $purchaseDate = null,
        public ?Property\ReleaseDateModel $releaseDate = null,
        public ?Property\ReviewModel $review = null,
        public ?Property\ReviewsModel $reviews = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SerialNumberModel $serialNumber = null,
        public ?Property\SizeModel $size = null,
        public ?Property\SkuModel $sku = null,
        public ?Property\SloganModel $slogan = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UrlModel $url = null,
        public ?Property\WeightModel $weight = null,
        public ?Property\WidthModel $width = null,
    ) {
    }
}
