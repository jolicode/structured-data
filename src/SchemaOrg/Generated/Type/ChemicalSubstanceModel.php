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

final class ChemicalSubstanceModel
{
    public const DESCRIPTION = 'A chemical substance is \'a portion of matter of constant composition, composed of molecular entities of the same type or of different types\' (source: [ChEBI:59999](https://www.ebi.ac.uk/chebi/searchId.do?chebiId=59999)).';
    public const LABEL = 'ChemicalSubstance';
    public const NAME = 'schema:ChemicalSubstance';
    public const PARENTS = ['BioChemEntityModel' => 'Jolicode\SchemaOrg\Type\BioChemEntityModel'];
    public const ENUMERATION_MEMBERS = [];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\AssociatedDiseaseModel $associatedDisease = null,
        public ?Property\BioChemInteractionModel $bioChemInteraction = null,
        public ?Property\BioChemSimilarityModel $bioChemSimilarity = null,
        public ?Property\BiologicalRoleModel $biologicalRole = null,
        public ?Property\ChemicalCompositionModel $chemicalComposition = null,
        public ?Property\ChemicalRoleModel $chemicalRole = null,
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
        public ?Property\PotentialUseModel $potentialUse = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\TaxonomicRangeModel $taxonomicRange = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
