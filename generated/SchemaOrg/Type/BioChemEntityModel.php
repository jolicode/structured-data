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

final class BioChemEntityModel
{
    public const DESCRIPTION = 'Any biological, chemical, or biochemical thing. For example: a protein; a gene; a chemical; a synthetic chemical.';
    public const LABEL = 'BioChemEntity';
    public const NAME = 'schema:BioChemEntity';
    public const PARENTS = ['ThingModel' => 'SchemaOrg\\Type\\ThingModel'];
    public const ENUMERATION_MEMBERS = [];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\AssociatedDiseaseModel $associatedDisease = null,
        public ?Property\BioChemInteractionModel $bioChemInteraction = null,
        public ?Property\BioChemSimilarityModel $bioChemSimilarity = null,
        public ?Property\BiologicalRoleModel $biologicalRole = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\FundingModel $funding = null,
        public ?Property\HasBioChemEntityPartModel $hasBioChemEntityPart = null,
        public ?Property\HasMolecularFunctionModel $hasMolecularFunction = null,
        public ?Property\HasRepresentationModel $hasRepresentation = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\IsEncodedByBioChemEntityModel $isEncodedByBioChemEntity = null,
        public ?Property\IsInvolvedInBiologicalProcessModel $isInvolvedInBiologicalProcess = null,
        public ?Property\IsLocatedInSubcellularLocationModel $isLocatedInSubcellularLocation = null,
        public ?Property\IsPartOfBioChemEntityModel $isPartOfBioChemEntity = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\TaxonomicRangeModel $taxonomicRange = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
