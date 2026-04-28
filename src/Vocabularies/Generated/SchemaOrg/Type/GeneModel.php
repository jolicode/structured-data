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

final class GeneModel
{
    public const DESCRIPTION = 'A discrete unit of inheritance which affects one or more biological traits (Source: [https://en.wikipedia.org/wiki/Gene](https://en.wikipedia.org/wiki/Gene)). Examples include FOXP2 (Forkhead box protein P2), SCARNA21 (small Cajal body-specific RNA 21), A- (agouti genotype).';
    public const LABEL = 'Gene';
    public const NAME = 'schema:Gene';
    public const PARENTS = ['BioChemEntityModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\BioChemEntityModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['http://bioschemas.org'];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\AlternativeOfModel $alternativeOf = null,
        public ?Property\AssociatedDiseaseModel $associatedDisease = null,
        public ?Property\BioChemInteractionModel $bioChemInteraction = null,
        public ?Property\BioChemSimilarityModel $bioChemSimilarity = null,
        public ?Property\BiologicalRoleModel $biologicalRole = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\EncodesBioChemEntityModel $encodesBioChemEntity = null,
        public ?Property\ExpressedInModel $expressedIn = null,
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
