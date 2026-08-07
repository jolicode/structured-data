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

final class MedicalObservationalStudyDesignModel
{
    public const DESCRIPTION = 'Design models for observational medical studies. Enumerated type.';
    public const LABEL = 'MedicalObservationalStudyDesign';
    public const NAME = 'schema:MedicalObservationalStudyDesign';
    public const PARENTS = ['MedicalEnumerationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MedicalEnumerationModel'];
    public const ENUMERATION_MEMBERS = ['CaseSeriesModel' => 'EnumerationMember\CaseSeriesModel', 'CohortStudyModel' => 'EnumerationMember\CohortStudyModel', 'CrossSectionalModel' => 'EnumerationMember\CrossSectionalModel', 'LongitudinalModel' => 'EnumerationMember\LongitudinalModel', 'ObservationalModel' => 'EnumerationMember\ObservationalModel', 'RegistryModel' => 'EnumerationMember\RegistryModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\SupersededByModel $supersededBy = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
