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

final class MedicalDeviceModel
{
    public const DESCRIPTION = 'Any object used in a medical capacity, such as to diagnose or treat a patient.';
    public const LABEL = 'MedicalDevice';
    public const NAME = 'schema:MedicalDevice';
    public const PARENTS = ['MedicalEntityModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MedicalEntityModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AdverseOutcomeModel $adverseOutcome = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\CodeModel $code = null,
        public ?Property\ContraindicationModel $contraindication = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\FundingModel $funding = null,
        public ?Property\GuidelineModel $guideline = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\LegalStatusModel $legalStatus = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\MedicineSystemModel $medicineSystem = null,
        public ?Property\NameModel $name = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\PostOpModel $postOp = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\PreOpModel $preOp = null,
        public ?Property\ProcedureModel $procedure = null,
        public ?Property\RecognizingAuthorityModel $recognizingAuthority = null,
        public ?Property\RelevantSpecialtyModel $relevantSpecialty = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SeriousAdverseOutcomeModel $seriousAdverseOutcome = null,
        public ?Property\StudyModel $study = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
