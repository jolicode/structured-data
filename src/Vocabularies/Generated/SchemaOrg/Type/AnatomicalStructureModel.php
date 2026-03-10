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

final class AnatomicalStructureModel
{
    public const DESCRIPTION = 'Any part of the human body, typically a component of an anatomical system. Organs, tissues, and cells are all anatomical structures.';
    public const LABEL = 'AnatomicalStructure';
    public const NAME = 'schema:AnatomicalStructure';
    public const PARENTS = ['MedicalEntityModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MedicalEntityModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\AssociatedPathophysiologyModel $associatedPathophysiology = null,
        public ?Property\BodyLocationModel $bodyLocation = null,
        public ?Property\CodeModel $code = null,
        public ?Property\ConnectedToModel $connectedTo = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DiagramModel $diagram = null,
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
        public ?Property\PartOfSystemModel $partOfSystem = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\RecognizingAuthorityModel $recognizingAuthority = null,
        public ?Property\RelatedConditionModel $relatedCondition = null,
        public ?Property\RelatedTherapyModel $relatedTherapy = null,
        public ?Property\RelevantSpecialtyModel $relevantSpecialty = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\StudyModel $study = null,
        public ?Property\SubStructureModel $subStructure = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
