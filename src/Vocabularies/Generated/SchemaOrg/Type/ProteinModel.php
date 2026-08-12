<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type;

use JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class ProteinModel
{
    public const DESCRIPTION = 'Protein is here used in its widest possible definition, as classes of amino acid based molecules. Amyloid-beta Protein in human (UniProt P05067), eukaryota (e.g. an OrthoDB group) or even a single molecule that one can point to are all of type :Protein. A protein can thus be a subclass of another protein, e.g. :Protein as a UniProt record can have multiple isoforms inside it which would also be :Protein. They can be imagined, synthetic, hypothetical or naturally occurring.';
    public const LABEL = 'Protein';
    public const NAME = 'schema:Protein';
    public const PARENTS = ['BioChemEntityModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\BioChemEntityModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['http://bioschemas.org'];
    public const SUPERSEDED_BY = null;

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
        public ?Property\HasBioPolymerSequenceModel $hasBioPolymerSequence = null,
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
        public ?Property\OwnerModel $owner = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\TaxonomicRangeModel $taxonomicRange = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
