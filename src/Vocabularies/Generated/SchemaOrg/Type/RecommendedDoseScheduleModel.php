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

final class RecommendedDoseScheduleModel
{
    public const DESCRIPTION = 'A recommended dosing schedule for a drug or supplement as prescribed or recommended by an authority or by the drug/supplement\'s manufacturer. Capture the recommending authority in the recognizingAuthority property of MedicalEntity.';
    public const LABEL = 'RecommendedDoseSchedule';
    public const NAME = 'schema:RecommendedDoseSchedule';
    public const PARENTS = ['DoseScheduleModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DoseScheduleModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\CodeModel $code = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\DoseUnitModel $doseUnit = null,
        public ?Property\DoseValueModel $doseValue = null,
        public ?Property\FrequencyModel $frequency = null,
        public ?Property\FundingModel $funding = null,
        public ?Property\GuidelineModel $guideline = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\LegalStatusModel $legalStatus = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\MedicineSystemModel $medicineSystem = null,
        public ?Property\NameModel $name = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\RecognizingAuthorityModel $recognizingAuthority = null,
        public ?Property\RelevantSpecialtyModel $relevantSpecialty = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\StudyModel $study = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\TargetPopulationModel $targetPopulation = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
