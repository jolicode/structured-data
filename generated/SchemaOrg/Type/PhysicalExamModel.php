<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Type;

use SchemaOrg\Property;

final class PhysicalExamModel
{
    public const DESCRIPTION = 'A type of physical examination of a patient performed by a physician. ';
    public const LABEL = 'PhysicalExam';
    public const NAME = 'schema:PhysicalExam';
    public const PARENTS = ['MedicalEnumerationModel' => 'SchemaOrg\Type\MedicalEnumerationModel', 'MedicalProcedureModel' => 'SchemaOrg\Type\MedicalProcedureModel'];
    public const ENUMERATION_MEMBERS = ['AbdomenModel' => 'EnumerationMember\AbdomenModel', 'AppearanceModel' => 'EnumerationMember\AppearanceModel', 'CardiovascularExamModel' => 'EnumerationMember\CardiovascularExamModel', 'EarModel' => 'EnumerationMember\EarModel', 'EyeModel' => 'EnumerationMember\EyeModel', 'GenitourinaryModel' => 'EnumerationMember\GenitourinaryModel', 'HeadModel' => 'EnumerationMember\HeadModel', 'LungModel' => 'EnumerationMember\LungModel', 'MusculoskeletalExamModel' => 'EnumerationMember\MusculoskeletalExamModel', 'NeckModel' => 'EnumerationMember\NeckModel', 'NeuroModel' => 'EnumerationMember\NeuroModel', 'NoseModel' => 'EnumerationMember\NoseModel', 'SkinModel' => 'EnumerationMember\SkinModel', 'ThroatModel' => 'EnumerationMember\ThroatModel'];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\BodyLocationModel $bodyLocation = null,
        public ?Property\CodeModel $code = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
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
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\PreparationModel $preparation = null,
        public ?Property\ProcedureTypeModel $procedureType = null,
        public ?Property\RecognizingAuthorityModel $recognizingAuthority = null,
        public ?Property\RelevantSpecialtyModel $relevantSpecialty = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\StatusModel $status = null,
        public ?Property\StudyModel $study = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\SupersededByModel $supersededBy = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
