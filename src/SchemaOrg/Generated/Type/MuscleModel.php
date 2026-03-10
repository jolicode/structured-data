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

final class MuscleModel
{
    public const DESCRIPTION = 'A muscle is an anatomical structure consisting of a contractile form of tissue that animals use to effect movement.';
    public const LABEL = 'Muscle';
    public const NAME = 'schema:Muscle';
    public const PARENTS = ['AnatomicalStructureModel' => 'Jolicode\SchemaOrg\Type\AnatomicalStructureModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\AntagonistModel $antagonist = null,
        public ?Property\AssociatedPathophysiologyModel $associatedPathophysiology = null,
        public ?Property\BloodSupplyModel $bloodSupply = null,
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
        public ?Property\InsertionModel $insertion = null,
        public ?Property\LegalStatusModel $legalStatus = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\MedicineSystemModel $medicineSystem = null,
        public ?Property\MuscleActionModel $muscleAction = null,
        public ?Property\NameModel $name = null,
        public ?Property\NerveModel $nerve = null,
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
