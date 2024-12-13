<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Type;

use Jolicode\SchemaOrg\Property;

final class MedicalSignOrSymptomModel
{
    public const DESCRIPTION = 'Any feature associated or not with a medical condition. In medicine a symptom is generally subjective while a sign is objective.';
    public const LABEL = 'MedicalSignOrSymptom';
    public const NAME = 'schema:MedicalSignOrSymptom';
    public const PARENTS = ['MedicalConditionModel' => 'Jolicode\SchemaOrg\Type\MedicalConditionModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\AssociatedAnatomyModel $associatedAnatomy = null,
        public ?Property\CodeModel $code = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DifferentialDiagnosisModel $differentialDiagnosis = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\DrugModel $drug = null,
        public ?Property\EpidemiologyModel $epidemiology = null,
        public ?Property\ExpectedPrognosisModel $expectedPrognosis = null,
        public ?Property\FundingModel $funding = null,
        public ?Property\GuidelineModel $guideline = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\LegalStatusModel $legalStatus = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\MedicineSystemModel $medicineSystem = null,
        public ?Property\NameModel $name = null,
        public ?Property\NaturalProgressionModel $naturalProgression = null,
        public ?Property\PathophysiologyModel $pathophysiology = null,
        public ?Property\PossibleComplicationModel $possibleComplication = null,
        public ?Property\PossibleTreatmentModel $possibleTreatment = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\PrimaryPreventionModel $primaryPrevention = null,
        public ?Property\RecognizingAuthorityModel $recognizingAuthority = null,
        public ?Property\RelevantSpecialtyModel $relevantSpecialty = null,
        public ?Property\RiskFactorModel $riskFactor = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SecondaryPreventionModel $secondaryPrevention = null,
        public ?Property\SignOrSymptomModel $signOrSymptom = null,
        public ?Property\StageModel $stage = null,
        public ?Property\StatusModel $status = null,
        public ?Property\StudyModel $study = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\TypicalTestModel $typicalTest = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
