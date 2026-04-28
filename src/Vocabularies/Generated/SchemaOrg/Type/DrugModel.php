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

final class DrugModel
{
    public const DESCRIPTION = 'A chemical or biologic substance, used as a medical therapy, that has a physiological effect on an organism. Here the term drug is used interchangeably with the term medicine although clinical knowledge makes a clear difference between them.';
    public const LABEL = 'Drug';
    public const NAME = 'schema:Drug';
    public const PARENTS = ['ProductModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ProductModel', 'SubstanceModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\SubstanceModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];

    public function __construct(
        public ?Property\ActiveIngredientModel $activeIngredient = null,
        public ?Property\AdditionalPropertyModel $additionalProperty = null,
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AdministrationRouteModel $administrationRoute = null,
        public ?Property\AggregateRatingModel $aggregateRating = null,
        public ?Property\AlcoholWarningModel $alcoholWarning = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\AsinModel $asin = null,
        public ?Property\AudienceModel $audience = null,
        public ?Property\AvailableStrengthModel $availableStrength = null,
        public ?Property\AwardModel $award = null,
        public ?Property\AwardsModel $awards = null,
        public ?Property\BrandModel $brand = null,
        public ?Property\BreastfeedingWarningModel $breastfeedingWarning = null,
        public ?Property\CategoryModel $category = null,
        public ?Property\ClincalPharmacologyModel $clincalPharmacology = null,
        public ?Property\ClinicalPharmacologyModel $clinicalPharmacology = null,
        public ?Property\CodeModel $code = null,
        public ?Property\ColorModel $color = null,
        public ?Property\ColorSwatchModel $colorSwatch = null,
        public ?Property\CountryOfAssemblyModel $countryOfAssembly = null,
        public ?Property\CountryOfLastProcessingModel $countryOfLastProcessing = null,
        public ?Property\CountryOfOriginModel $countryOfOrigin = null,
        public ?Property\DepthModel $depth = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\DisplayLocationModel $displayLocation = null,
        public ?Property\DosageFormModel $dosageForm = null,
        public ?Property\DoseScheduleModel $doseSchedule = null,
        public ?Property\DrugClassModel $drugClass = null,
        public ?Property\DrugUnitModel $drugUnit = null,
        public ?Property\FoodWarningModel $foodWarning = null,
        public ?Property\FundingModel $funding = null,
        public ?Property\GtinModel $gtin = null,
        public ?Property\Gtin12Model $gtin12 = null,
        public ?Property\Gtin13Model $gtin13 = null,
        public ?Property\Gtin14Model $gtin14 = null,
        public ?Property\Gtin8Model $gtin8 = null,
        public ?Property\GuidelineModel $guideline = null,
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
        public ?Property\IncludedInHealthInsurancePlanModel $includedInHealthInsurancePlan = null,
        public ?Property\InteractingDrugModel $interactingDrug = null,
        public ?Property\IsAccessoryOrSparePartForModel $isAccessoryOrSparePartFor = null,
        public ?Property\IsAvailableGenericallyModel $isAvailableGenerically = null,
        public ?Property\IsConsumableForModel $isConsumableFor = null,
        public ?Property\IsFamilyFriendlyModel $isFamilyFriendly = null,
        public ?Property\IsProprietaryModel $isProprietary = null,
        public ?Property\IsRelatedToModel $isRelatedTo = null,
        public ?Property\IsSimilarToModel $isSimilarTo = null,
        public ?Property\IsVariantOfModel $isVariantOf = null,
        public ?Property\ItemConditionModel $itemCondition = null,
        public ?Property\KeywordsModel $keywords = null,
        public ?Property\LabelDetailsModel $labelDetails = null,
        public ?Property\LegalStatusModel $legalStatus = null,
        public ?Property\LogoModel $logo = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\ManufacturerModel $manufacturer = null,
        public ?Property\MaterialModel $material = null,
        public ?Property\MaximumIntakeModel $maximumIntake = null,
        public ?Property\MechanismOfActionModel $mechanismOfAction = null,
        public ?Property\MedicineSystemModel $medicineSystem = null,
        public ?Property\MobileUrlModel $mobileUrl = null,
        public ?Property\ModelModel $model = null,
        public ?Property\MpnModel $mpn = null,
        public ?Property\NameModel $name = null,
        public ?Property\NegativeNotesModel $negativeNotes = null,
        public ?Property\NonProprietaryNameModel $nonProprietaryName = null,
        public ?Property\NsnModel $nsn = null,
        public ?Property\OffersModel $offers = null,
        public ?Property\OverdosageModel $overdosage = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\PatternModel $pattern = null,
        public ?Property\PositiveNotesModel $positiveNotes = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\PregnancyCategoryModel $pregnancyCategory = null,
        public ?Property\PregnancyWarningModel $pregnancyWarning = null,
        public ?Property\PrescribingInfoModel $prescribingInfo = null,
        public ?Property\PrescriptionStatusModel $prescriptionStatus = null,
        public ?Property\ProductIDModel $productID = null,
        public ?Property\ProductionDateModel $productionDate = null,
        public ?Property\ProprietaryNameModel $proprietaryName = null,
        public ?Property\PurchaseDateModel $purchaseDate = null,
        public ?Property\RecognizingAuthorityModel $recognizingAuthority = null,
        public ?Property\RelatedDrugModel $relatedDrug = null,
        public ?Property\ReleaseDateModel $releaseDate = null,
        public ?Property\RelevantSpecialtyModel $relevantSpecialty = null,
        public ?Property\ReviewModel $review = null,
        public ?Property\ReviewsModel $reviews = null,
        public ?Property\RxcuiModel $rxcui = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SizeModel $size = null,
        public ?Property\SkuModel $sku = null,
        public ?Property\SloganModel $slogan = null,
        public ?Property\StudyModel $study = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UrlModel $url = null,
        public ?Property\WarningModel $warning = null,
        public ?Property\WeightModel $weight = null,
        public ?Property\WidthModel $width = null,
    ) {
    }
}
