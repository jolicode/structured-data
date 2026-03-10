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

final class MolecularEntityModel
{
    public const DESCRIPTION = 'Any constitutionally or isotopically distinct atom, molecule, ion, ion pair, radical, radical ion, complex, conformer etc., identifiable as a separately distinguishable entity.';
    public const LABEL = 'MolecularEntity';
    public const NAME = 'schema:MolecularEntity';
    public const PARENTS = ['BioChemEntityModel' => 'Jolicode\SchemaOrg\Type\BioChemEntityModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['http://bioschemas.org'];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\AssociatedDiseaseModel $associatedDisease = null,
        public ?Property\BioChemInteractionModel $bioChemInteraction = null,
        public ?Property\BioChemSimilarityModel $bioChemSimilarity = null,
        public ?Property\BiologicalRoleModel $biologicalRole = null,
        public ?Property\ChemicalRoleModel $chemicalRole = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\FundingModel $funding = null,
        public ?Property\HasBioChemEntityPartModel $hasBioChemEntityPart = null,
        public ?Property\HasMolecularFunctionModel $hasMolecularFunction = null,
        public ?Property\HasRepresentationModel $hasRepresentation = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\InChIModel $inChI = null,
        public ?Property\InChIKeyModel $inChIKey = null,
        public ?Property\IsEncodedByBioChemEntityModel $isEncodedByBioChemEntity = null,
        public ?Property\IsInvolvedInBiologicalProcessModel $isInvolvedInBiologicalProcess = null,
        public ?Property\IsLocatedInSubcellularLocationModel $isLocatedInSubcellularLocation = null,
        public ?Property\IsPartOfBioChemEntityModel $isPartOfBioChemEntity = null,
        public ?Property\IupacNameModel $iupacName = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\MolecularFormulaModel $molecularFormula = null,
        public ?Property\MolecularWeightModel $molecularWeight = null,
        public ?Property\MonoisotopicMolecularWeightModel $monoisotopicMolecularWeight = null,
        public ?Property\NameModel $name = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\PotentialUseModel $potentialUse = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SmilesModel $smiles = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\TaxonomicRangeModel $taxonomicRange = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
