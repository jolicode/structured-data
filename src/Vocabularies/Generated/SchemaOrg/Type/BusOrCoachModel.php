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

final class BusOrCoachModel
{
    public const DESCRIPTION = 'A bus (also omnibus or autobus) is a road vehicle designed to carry passengers. Coaches are luxury buses, usually in service for long distance travel.';
    public const LABEL = 'BusOrCoach';
    public const NAME = 'schema:BusOrCoach';
    public const PARENTS = ['VehicleModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\VehicleModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = ['https://auto.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;

    public function __construct(
        public ?Property\AccelerationTimeModel $accelerationTime = null,
        public ?Property\AcrissCodeModel $acrissCode = null,
        public ?Property\AdditionalPropertyModel $additionalProperty = null,
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AggregateRatingModel $aggregateRating = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\AsinModel $asin = null,
        public ?Property\AudienceModel $audience = null,
        public ?Property\AwardModel $award = null,
        public ?Property\AwardsModel $awards = null,
        public ?Property\BodyTypeModel $bodyType = null,
        public ?Property\BrandModel $brand = null,
        public ?Property\CallSignModel $callSign = null,
        public ?Property\CargoVolumeModel $cargoVolume = null,
        public ?Property\CategoryModel $category = null,
        public ?Property\ColorModel $color = null,
        public ?Property\ColorSwatchModel $colorSwatch = null,
        public ?Property\CountryOfAssemblyModel $countryOfAssembly = null,
        public ?Property\CountryOfLastProcessingModel $countryOfLastProcessing = null,
        public ?Property\CountryOfOriginModel $countryOfOrigin = null,
        public ?Property\DateVehicleFirstRegisteredModel $dateVehicleFirstRegistered = null,
        public ?Property\DepthModel $depth = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\DisplayLocationModel $displayLocation = null,
        public ?Property\DriveWheelConfigurationModel $driveWheelConfiguration = null,
        public ?Property\EmissionsCO2Model $emissionsCO2 = null,
        public ?Property\FuelCapacityModel $fuelCapacity = null,
        public ?Property\FuelConsumptionModel $fuelConsumption = null,
        public ?Property\FuelEfficiencyModel $fuelEfficiency = null,
        public ?Property\FuelTypeModel $fuelType = null,
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
        public ?Property\KnownVehicleDamagesModel $knownVehicleDamages = null,
        public ?Property\LogoModel $logo = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\ManufacturerModel $manufacturer = null,
        public ?Property\MaterialModel $material = null,
        public ?Property\MeetsEmissionStandardModel $meetsEmissionStandard = null,
        public ?Property\MileageFromOdometerModel $mileageFromOdometer = null,
        public ?Property\MobileUrlModel $mobileUrl = null,
        public ?Property\ModelModel $model = null,
        public ?Property\ModelDateModel $modelDate = null,
        public ?Property\MpnModel $mpn = null,
        public ?Property\NameModel $name = null,
        public ?Property\NegativeNotesModel $negativeNotes = null,
        public ?Property\NsnModel $nsn = null,
        public ?Property\NumberOfAirbagsModel $numberOfAirbags = null,
        public ?Property\NumberOfAxlesModel $numberOfAxles = null,
        public ?Property\NumberOfDoorsModel $numberOfDoors = null,
        public ?Property\NumberOfForwardGearsModel $numberOfForwardGears = null,
        public ?Property\NumberOfPreviousOwnersModel $numberOfPreviousOwners = null,
        public ?Property\OffersModel $offers = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\PatternModel $pattern = null,
        public ?Property\PayloadModel $payload = null,
        public ?Property\PositiveNotesModel $positiveNotes = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\ProductIDModel $productID = null,
        public ?Property\ProductionDateModel $productionDate = null,
        public ?Property\PurchaseDateModel $purchaseDate = null,
        public ?Property\ReleaseDateModel $releaseDate = null,
        public ?Property\ReviewModel $review = null,
        public ?Property\ReviewsModel $reviews = null,
        public ?Property\RoofLoadModel $roofLoad = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SeatingCapacityModel $seatingCapacity = null,
        public ?Property\SizeModel $size = null,
        public ?Property\SkuModel $sku = null,
        public ?Property\SloganModel $slogan = null,
        public ?Property\SpeedModel $speed = null,
        public ?Property\SteeringPositionModel $steeringPosition = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\TongueWeightModel $tongueWeight = null,
        public ?Property\TrailerWeightModel $trailerWeight = null,
        public ?Property\UrlModel $url = null,
        public ?Property\VehicleConfigurationModel $vehicleConfiguration = null,
        public ?Property\VehicleEngineModel $vehicleEngine = null,
        public ?Property\VehicleIdentificationNumberModel $vehicleIdentificationNumber = null,
        public ?Property\VehicleInteriorColorModel $vehicleInteriorColor = null,
        public ?Property\VehicleInteriorTypeModel $vehicleInteriorType = null,
        public ?Property\VehicleModelDateModel $vehicleModelDate = null,
        public ?Property\VehicleSeatingCapacityModel $vehicleSeatingCapacity = null,
        public ?Property\VehicleSpecialUsageModel $vehicleSpecialUsage = null,
        public ?Property\VehicleTransmissionModel $vehicleTransmission = null,
        public ?Property\WeightModel $weight = null,
        public ?Property\WeightTotalModel $weightTotal = null,
        public ?Property\WheelbaseModel $wheelbase = null,
        public ?Property\WidthModel $width = null,
    ) {
    }
}
