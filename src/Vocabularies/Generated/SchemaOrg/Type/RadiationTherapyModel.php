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

final class RadiationTherapyModel
{
    public const DESCRIPTION = 'A process of care using radiation aimed at improving a health condition.';
    public const LABEL = 'RadiationTherapy';
    public const NAME = 'schema:RadiationTherapy';
    public const PARENTS = ['MedicalTherapyModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MedicalTherapyModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AdverseOutcomeModel $adverseOutcome = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\BodyLocationModel $bodyLocation = null,
        public ?Property\CodeModel $code = null,
        public ?Property\ContraindicationModel $contraindication = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\DoseScheduleModel $doseSchedule = null,
        public ?Property\DrugModel $drug = null,
        public ?Property\DuplicateTherapyModel $duplicateTherapy = null,
        public ?Property\FollowupModel $followup = null,
        public ?Property\FundingModel $funding = null,
        public ?Property\GuidelineModel $guideline = null,
        public ?Property\HowPerformedModel $howPerformed = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\LegalStatusModel $legalStatus = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\MedicineSystemModel $medicineSystem = null,
        public ?Property\NameModel $name = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\PreparationModel $preparation = null,
        public ?Property\ProcedureTypeModel $procedureType = null,
        public ?Property\RecognizingAuthorityModel $recognizingAuthority = null,
        public ?Property\RelevantSpecialtyModel $relevantSpecialty = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SeriousAdverseOutcomeModel $seriousAdverseOutcome = null,
        public ?Property\StatusModel $status = null,
        public ?Property\StudyModel $study = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
