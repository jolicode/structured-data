<?php

declare(strict_types=1);

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

final class NerveModel
{
    public const DESCRIPTION = 'A common pathway for the electrochemical nerve impulses that are transmitted along each of the axons.';
    public const LABEL = 'Nerve';
    public const NAME = 'schema:Nerve';
    public const PARENTS = ['AnatomicalStructureModel' => 'SchemaOrg\\Type\\AnatomicalStructureModel'];
    public const ENUMERATION_MEMBERS = [];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\AssociatedPathophysiologyModel $associatedPathophysiology = null,
        public ?Property\BodyLocationModel $bodyLocation = null,
        public ?Property\BranchModel $branch = null,
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
        public ?Property\NerveMotorModel $nerveMotor = null,
        public ?Property\PartOfSystemModel $partOfSystem = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\RecognizingAuthorityModel $recognizingAuthority = null,
        public ?Property\RelatedConditionModel $relatedCondition = null,
        public ?Property\RelatedTherapyModel $relatedTherapy = null,
        public ?Property\RelevantSpecialtyModel $relevantSpecialty = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SensoryUnitModel $sensoryUnit = null,
        public ?Property\SourcedFromModel $sourcedFrom = null,
        public ?Property\StudyModel $study = null,
        public ?Property\SubStructureModel $subStructure = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
